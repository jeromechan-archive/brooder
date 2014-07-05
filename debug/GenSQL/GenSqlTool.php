<?php

class GenSqlTool{

    private $_responseEntity;

    private $_requestEntity;

    public function __construct()
    {
        $this->_requestEntity = $_POST;
    }

    public function getRequestEntity($key)
    {
        return $this->_requestEntity[$key];
    }

    public function getResponseEntity($key)
    {
        return $this->_responseEntity[$key];
    }

    public function doTranslate()
    {
        $struct = $this->_requestEntity['struct'];
        if ($struct) {

            $rows = split("\n", $struct);
            $row_num = 0;

            $table = array();
            $tableCommont = ''; //表注释
            $tableName = ''; //表名

            foreach ($rows as $row) {
                if (!$row)
                    continue;
                $row_num++;

                if ($row_num == 1) {
                    $table['注释'] .=trim($row);
                } elseif ($row_num == 2) {
                    $table['表名'] .= trim($row);
                } elseif ($row_num == 3) {
                    
                } else {
                    $col_array = array();
                    $cols = preg_split("/\s/", $row);
                    if(count($cols) < 3){
                        continue;
                    }
                    $index = 0;
                    while ($cols[$index + 2] == '') {
                        $index++;
                        if ($index > 100)
                            break;
                    }
                    $col_array['列名'] = $cols[$index + 2];
                    while ($cols[$index + 3] == '') {
                        $index++;
                        if ($index > 100)
                            break;
                    }
                    $col_array['数据类型'] = $cols[$index + 3];
                    $col_array['主键'] = $cols[$index + 4];
                    $col_array['可空'] = $cols[$index + 5];
                    $col_array['默认'] = $cols[$index + 7];

                    $commen = $cols[$index + 8];
                    for ($i = 9; $i < count($cols); $i++) {
                        $commen .= $cols[$i];
                    }

                    $fk = trim($cols[$index + 6], ' ');
                    $col_array['注释'] = $cols[$index + 1] . ';'
                            . $commen . ($fk ? ';外键：' . $fk : '');
                    $table['字段'][] = $col_array;
                }
            }
            if ($this->_requestEntity['create_way'] == 'c') {
                $sql = $this->getCreateTableSql($table);
            } elseif ($this->_requestEntity['create_way'] == 'a') {
                $sql = $this->getAlterTableSql($table);
            }
            $this->_responseEntity['tgt_struct'] = $sql;
        }
    }

    function getAlterTableSql($table) {
        $sql = "ALTER TABLE {$table['表名']}";
        foreach ($table['字段'] as $col) {
            $sql .="\n CHANGE {$col['列名']} {$col['列名']} {$this->getDataType($col['数据类型'])} {$this->getCanEmpty($col_array['可空'])} {$this->getDefault($col['默认'], $col['数据类型'])} COMMENT '{$col['注释']}',";
        }
        $sql = trim($sql, ',');
        return $sql;
    }

    function getCreateTableSql($table) {
        $sql = " CREATE TABLE {$table['表名']} (\n";
        $key = '';
        foreach ($table['字段'] as $col) {
            $sql.="    {$col['列名']} {$this->getDataType($col['数据类型'])} {$this->getCanEmpty($col_array['可空'])} {$this->getDefault($col['默认'], $col['数据类型'])} COMMENT '{$col['注释']}',\n";
            if ($col['主键'] == '是') {
                $key = $col['列名'];
            }
        }
        if ($key) {
            $sql.="PRIMARY KEY ($key)\n";
        }
        $sql.=" ) ENGINE=MYISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='{$table['注释']}';";

        return $sql;
    }

    function getDefault($default, $dataType) {
        if (!$default && !is_numeric($default)) {
            if ($dataType == "INT" || $dataType == "TINYINT" || $dataType == "MEDIUMINT" || $dataType == "SMALLINT") {
                return " DEFAULT 0";
            }
            if ($dataType == "DATE") {
                return " DEFAULT '0000-00-00'";
            }
            if ($dataType == "DATETIME") {
                return " DEFAULT '0000-00-00 00:00:00'";
            }
            return " DEFAULT ''";
        }
        if ($default == '自增') {
            return 'AUTO_INCREMENT';
        }
        if (is_numeric($default)) {
            return ' DEFAULT ' . $default;
        }
        if ($default == 'CURRENT_TIMESTAMP') {
            return ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP';
        }
        $default = str_replace('‘', '', $default);
        $default = str_replace('’', '', $default);
        $default = str_replace('\'', '', $default);
        return " DEFAULT '$default'";
    }

    function getCanEmpty($can_empty) {
        if ($can_empty == '否') {
            return 'NOT NULL';
        }
        return '';
    }

    function getDataType($data_type) {
        if ($data_type == 'INT') {
            $data_type = 'INT(10)';
        } elseif ($data_type == 'TINYINT') {
            $data_type = 'TINYINT(3)';
        } elseif ($data_type == 'MEDIUMINT') {
            $data_type = 'MEDIUMINT(8)';
        } elseif ($data_type == 'SMALLINT') {
            $data_type = 'SMALLINT(5)';
        }
        return $data_type;
    }

}

$GenSqlObject = new GenSqlTool();
$GenSqlObject->doTranslate();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Generate DDL-SQL</title>
</head>
<body>
<?php

?>
<form method="post" action="./GenSqlTool.php">
    <table cellpadding="0" cellspacing="0" border="0" class="common_list_t">
        <tr>
            <td><select name="create_way">
                    <option value="c">create table</option>
                    <!--<option value="a">alter table</option>-->
                </select> <input type="submit" value="生成SQL"/>
            </td>
        </tr>
        <tr>
            <td>源数据</td>
        </tr>
        <tr>
            <td><textarea name="src_struct" style="width:1000px" rows="16"><?php echo $GenSqlObject->getRequestEntity('src_struct'); ?></textarea></td>
        </tr>
        <tr>
            <td>结果数据</td>
        </tr>
        <tr>
            <td><textarea name="tgt_struct" style="width:1000px" rows="16"><?php echo $GenSqlObject->getResponseEntity('tgt_struct'); ?></textarea></td>
        </tr>
    </table>
</form>
</body>
</html>
