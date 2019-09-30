<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$howschooldoing = [];
/* groups procedures */
/* method name would be key name and value would be procedure name */
$howschooldoing['getAssessmentList'] = "sGetAssessmentList"; /* sGetAssessmentList(IN PAY_Code VARCHAR(16), IN PUser_Code VARCHAR(16), IN PIsMine INT) */
$howschooldoing['getGrades'] = "sGetGrades"; /* sGetGrades() */
$howschooldoing['getClasswiseGraph'] = "sGetClasswiseGraph"; /* sGetClasswiseGraph(IN PUser_Code varchar(16),IN PClass_Code varchar(16),IN PGrade varchar(16) ,IN PAssessment_Id int) */
$howschooldoing['getClassSectionwiseGraph'] = "sGetClassSectionwiseGraph"; /* sGetClassSectionwiseGraph(IN PUser_Code varchar(16), IN PClass_Code varchar(16), IN PGrade varchar(16), IN PAssessment_Id int) */
$howschooldoing['getClassSectionSubjectwiseGraph'] = "sGetClassSectionSubjectwiseGraph"; /* sGetClassSectionSubjectwiseGraph(IN PUser_Code varchar(16), IN PClass_Code varchar(16), IN PSection_Code VARCHAR(16), IN PGrade varchar(16), IN PAssessment_Id int) */
$howschooldoing['getClassSectionStudentGraph'] = "sGetClassSectionStudentGraph"; /* sGetClassSectionStudentGraph(IN PUser_Code varchar(16), IN PClass_Code varchar(16), IN PSection_Code varchar(16), IN PSubject_Code VARCHAR(16), IN PGrade varchar(16), IN PAssessment_Id int) */
$howschooldoing['getTeacherSubjectwiseGraph'] = "sGetTeacherSubjectwiseGraph"; /* sGetTeacherSubjectwiseGraph(IN PUser_Code varchar(16), IN PAssessment_Id int, IN PTeacher_Code varchar(1024), IN PSubject_Code varchar(1024), IN PGrade varchar(16)) */
$howschooldoing['getTeacherSubjectClasswiseGraph'] = "sGetTeacherSubjectClasswiseGraph"; /* sGetTeacherSubjectClasswiseGraph(IN PUser_Code varchar(16), IN PAssessment_Id int, IN PTeacher_Code varchar(16), IN PGrade varchar(16), IN PSubject_Code varchar(16)) */
$howschooldoing['getTeacherSubjectClassSectionwiseGraph'] = "sGetTeacherSubjectClassSectionwiseGraph"; /*
                                                                                                        * sGetTeacherSubjectClassSectionwiseGraph(IN PUser_Code varchar(16), IN PAssessment_Id int, IN PTeacher_Code varchar(16), IN PGrade varchar(16), IN PClass_Code varchar(16), IN PSubject_Code varchar(16))
                                                                                                        */
$howschooldoing['getTeacherSubjectClassSectionStudentGraph'] = "sGetTeacherSubjectClassSectionStudentGraph"; /* sGetTeacherSubjectClassSectionStudentGraph(IN PUser_Code varchar(16), IN PAssessment_Id int, IN PTeacher_Code varchar(16), IN PGrade varchar(16), IN PClass_Code varchar(16), IN PSection_Code varchar(16), IN PSubject_Code varchar(16)) */

$config['howschooldoing'] = $howschooldoing; // key name must be controller class name in lower case
