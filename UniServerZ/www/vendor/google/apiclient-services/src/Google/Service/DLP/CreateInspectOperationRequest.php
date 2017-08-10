<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_DLP_CreateInspectOperationRequest extends Google_Model
{
  protected $inspectConfigType = 'Google_Service_DLP_InspectConfig';
  protected $inspectConfigDataType = '';
  protected $outputConfigType = 'Google_Service_DLP_OutputStorageConfig';
  protected $outputConfigDataType = '';
  protected $storageConfigType = 'Google_Service_DLP_StorageConfig';
  protected $storageConfigDataType = '';

  public function setInspectConfig(Google_Service_DLP_InspectConfig $inspectConfig)
  {
    $this->inspectConfig = $inspectConfig;
  }
  public function getInspectConfig()
  {
    return $this->inspectConfig;
  }
  public function setOutputConfig(Google_Service_DLP_OutputStorageConfig $outputConfig)
  {
    $this->outputConfig = $outputConfig;
  }
  public function getOutputConfig()
  {
    return $this->outputConfig;
  }
  public function setStorageConfig(Google_Service_DLP_StorageConfig $storageConfig)
  {
    $this->storageConfig = $storageConfig;
  }
  public function getStorageConfig()
  {
    return $this->storageConfig;
  }
}
