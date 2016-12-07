<?php
/**
 * Coypright © 2014 Jerome Chan. All rights reserved.
 * Author: chenjinlong
 * Date: 7/5/14
 * Time: 2:36 AM
 * Description: database.php
 */
$databaseConfig = array(
    'tj_master'=>array(
        'connectionString' => 'mysql:host=localhost;dbname=app_taojin;port=3306',
        'emulatePrepare' => false,
        'username' => 'root',
        'password' => 'root',
        'class' => 'CDbConnection',
		'autoConnect'=>false
    ),
);
