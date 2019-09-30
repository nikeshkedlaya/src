<?php

/**
 * @created by Sandeep kosta <sandeep@kaholabs.com> on 11 Dec, 2014 3:27:40 PM
 * 
 * Descripion: this library would be used for multiple mysql error handling and generate the error message for end user
 * 
 * Security : 
 * 
 * Change History :-
 * 
 * 
 * 
 * 
 * @Audited by :-
 */
class Mysqlerrorhandler
{

    const ErrCode_1146 = "Table does not exists";

    const ErrCode_1264 = "Inserting value out of ranbe";

    const ErrCode_1364 = "Please insert proper value";

    const ErrCode_1062 = "Please enter unique code";

    const ErrCode_1049 = "Unknown Database";

    const ErrCode_1451 = "Value already assigned with child";
 // while deleting the parent value though it is already assigned with child table
    public static function GetErrorMessages($PDOException)
    {
        if (empty($PDOException) === FALSE && is_object($PDOException) === TRUE) {
            switch ($PDOException->errorInfo[1]) {
                case "1146":
                    return self::ErrCode_1146;
                    break;
                case "1264":
                    return self::ErrCode_1264;
                    break;
                case "1364":
                    return self::ErrCode_1364;
                    break;
                case "1062":
                    return self::ErrCode_1062;
                    break;
                case "1049":
                    return self::ErrCode_1049;
                    break;
                default:
                    return FALSE;
            }
        }
    }
}
    