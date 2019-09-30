<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$general = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$general['updateMDM'] = "sUpdateMDM"; /* sUpdateMDM;
CREATE PROCEDURE sUpdateMDM
  (
    IN PUser_Code     VARCHAR(16),
    IN PDate          VARCHAR(64),
    IN PIs_Served     INT,
    IN PNumber_Served INT,
    IN PReason_ID     INT,
    IN PRemarks       TEXT CHARACTER SET utf8
                      COLLATE utf8_unicode_ci,
    IN PAttachment    TEXT
  )
 */ 

$general['updateFacility'] = "sUpdateFacility"; /* sUpdateFacility;
CREATE PROCEDURE sUpdateFacility(
  IN PUser_Code       VARCHAR(16),
  IN PFacility_Detail TEXT CHARACTER SET utf8
                      COLLATE utf8_unicode_ci,
  IN PDate            VARCHAR(24),
  IN PGeneral_Comment TEXT CHARACTER SET utf8
                      COLLATE utf8_unicode_ci)
 */

$general['getFacilities'] = "sGetFacilities"; /* sGetFacilities() */

$general['getMDMUpdates'] = "sGetMDMUpdates"; /* sGetMDMUpdates(IN PUser_Code VARCHAR(16), IN PFrom_Date VARCHAR(24), IN PTo_Date VARCHAR(24)) */

$config['general'] = $general; // key name must be controller class name in lower case
