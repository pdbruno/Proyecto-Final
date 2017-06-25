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

/**
 * The "operations" collection of methods.
 * Typical usage is:
 *  <code>
 *   $dlpService = new Google_Service_DLP(...);
 *   $operations = $dlpService->operations;
 *  </code>
 */
class Google_Service_DLP_Resource_InspectOperations extends Google_Service_Resource
{
  /**
   * Cancels an operation. Use the get method to check whether the cancellation
   * succeeded or whether the operation completed despite cancellation.
   * (operations.cancel)
   *
   * @param string $name The name of the operation resource to be cancelled.
   * @param Google_Service_DLP_CancelOperationRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_DLP_DlpEmpty
   */
  public function cancel($name, Google_Service_DLP_CancelOperationRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('cancel', array($params), "Google_Service_DLP_DlpEmpty");
  }
  /**
   * Schedule a job scanning content in a Google Cloud Platform data repository.
   * (operations.create)
   *
   * @param Google_Service_DLP_CreateInspectOperationRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_DLP_Operation
   */
  public function create(Google_Service_DLP_CreateInspectOperationRequest $postBody, $optParams = array())
  {
    $params = array('postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('create', array($params), "Google_Service_DLP_Operation");
  }
  /**
   * This method is not supported and the server returns `UNIMPLEMENTED`.
   * (operations.delete)
   *
   * @param string $name The name of the operation resource to be deleted.
   * @param array $optParams Optional parameters.
   * @return Google_Service_DLP_DlpEmpty
   */
  public function delete($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params), "Google_Service_DLP_DlpEmpty");
  }
  /**
   * Gets the latest state of a long-running operation.  Clients can use this
   * method to poll the operation result at intervals as recommended by the API
   * service. (operations.get)
   *
   * @param string $name The name of the operation resource.
   * @param array $optParams Optional parameters.
   * @return Google_Service_DLP_Operation
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_DLP_Operation");
  }
  /**
   * Lists operations that match the specified filter in the request. If the
   * server doesn't support this method, it returns `UNIMPLEMENTED`.
   *
   * NOTE: the `name` binding allows API services to override the binding to use
   * different resource name schemes, such as `users/operations`. To override the
   * binding, API services can add a binding such as
   * `"/v1/{name=users}/operations"` to their service configuration. For backwards
   * compatibility, the default name includes the operations collection id,
   * however overriding users must ensure the name binding is the parent resource,
   * without the operations collection id. (operations.listInspectOperations)
   *
   * @param string $name The name of the operation's parent resource.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter This parameter supports filtering by done, ie
   * done=true or done=false.
   * @opt_param string pageToken The list page token.
   * @opt_param int pageSize The list page size. The max allowed value is 256 and
   * default is 100.
   * @return Google_Service_DLP_ListOperationsResponse
   */
  public function listInspectOperations($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_DLP_ListOperationsResponse");
  }
}
