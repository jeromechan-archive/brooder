<?php
/**
 * Licensed to the Apache Software Foundation (ASF) under one or more
 * contributor license agreements. See the NOTICE file distributed with
 * this work for additional information regarding copyright ownership.
 * The ASF licenses this file to You under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 *
 *	   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package lbslogger
 */

/**
 * Coypright © 2013 Neilsen.Chan All rights reserved.
 *
 * The custom renderer, which is used when object or entity renderering is found.
 * Renders the input using <var>var_dump</var>.
 *
 * @author chenjinlong
 * @date 6/8/2013
 * @time 9:47 AM
 * @description VardumpRenderer.php
 * @since 0.3
 */
require_once '../vendor/apache/log4php/src/main/php/renderers/LoggerRenderer.php';

class LoggerRendererVardump implements LoggerRenderer
{
    /** @inheritdoc */
    public function render($content)
    {
        return var_dump($content);
    }
}
