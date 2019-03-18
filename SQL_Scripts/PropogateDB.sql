## file name    : PopulateDB.sql
## Created by   : Nick Skripnikov
## Date created : 04/01/2019
## Purpose      :- populate Bursary System (bursary_database) database with sample test data
## Notes        :-
## last updated : 03/02/2019 by: Nick Skripnikov & Mike Wright
## last updated : 07/02/2019 by: Mike Wright
## last updated : 09/02/2019 by: Nick Skripnikov
## last updated : 13/02/2019 by: Nick Skripnikov & Danny Mc
## change made  : 
##               - Added users (students, lecturers, admins) from different courses.
##               - added associated course data for new users.
##               - added some order data.
##               - added USE, so as data is added to the correct database.
##               - remarked-in some md5 encrypted passwords.
##               - removed pre-set user passwords.
##               - update query/table insert with ‘courseLevel’ data (used guess ‘courseID’ to ‘courseLevel)’.
##               - updated query to mach table change of "bRequestsDraft" to "bRequestsStatus ENUM" in "bursaryRequests" table
##               - Added additional courses and users and years


# connect to the Busary Request Database to be abble to add data
USE bursary_database;

#
#--- drop the DB WEB admin control user
#
DROP USER 'WEBAuth';
/* create test DB WEB admin*/
CREATE USER 'WEBAuth' IDENTIFIED BY 'WEBAuthPW';

/*give web admin SELECT and INSERT*/
GRANT ALL ON bursary_database.*  TO 'WEBAuth';

/*
Adding users to the DB
all testUser Accounts have their password set to:- PasswordA
which is then encrypted using md5, which is what is inserted into the database.*/
# md5 was 'cf622eb3d4a59567353c2a13cd702514'
# but now uses (userID + password), and then encrypts.

#-------Student user insertion------------#
# Nick md5 = '228367f8fa2f21aadceaedfae983e156'
# Danny md5 = '357afb1752b2244d3dff0f9059c818ee'
# Andrius md5  '741ff3f6dc942ef8422320452d0f4d40'
# no md5 reference confirm for the 2 new student users.
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (293779, "Nikita", "Skripnikov", '293779@student.lincolncollege.ac.uk', "Student", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (29000, "Danny", "McCoombs", '29000@student.lincolncollege.ac.uk', "Student", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (27865, "Andrius", "Williams", '27865@student.lincolncollege.ac.uk', "Student", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (25789, "Ben", "Hugh", '25789@student.lincolncollege.ac.uk', "Student", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (25432, "Jessica", "Roberts", '25432@student.lincolncollege.ac.uk', "Student", '1',FLOOR( RAND() * (9999-1000) + 1000));

#-------Staff user insertion------------#
# John md5 = '2a9d2ec24d4b9d69ebb7131e5767027f'
# Jeremy md5 = '0efc26550cc2437061eec003dfe637cd'
# Rebbeca md5 = 'f17c8ae0501ef044fab774e79792c170'
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (52354,"John","Rogers", 'JRogers@lincolncollege.ac.uk', "Staff", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userPassword, userEmail, userType, userActive,userPIN)
  VALUES (59021,"Jeremy","Smith", "0efc26550cc2437061eec003dfe637cd", 'JSmith@lincolncollege.ac.uk', "Staff", '1',FLOOR( RAND() * (9999-1000) + 1000));
INSERT INTO users (userID, userFirstName, userLastName, userPassword, userEmail, userType, userActive,userPIN)
  VALUES (53270,"Rebbeca","Jenkins", "f17c8ae0501ef044fab774e79792c170", 'RJenkins@lincolncollege.ac.uk', "Staff", '1',FLOOR( RAND() * (9999-1000) + 1000));

#-------Admin user insertion------------#
# Stephen md5 = 'eb64c27eb57c8f98c8a36d87d7464f3b'
INSERT INTO users (userID, userFirstName, userLastName, userEmail, userType, userActive,userPIN)
  VALUES (4561,"Stephen","Smith", 'SSmith@lincolncollege.ac.uk', "Admin", '1',FLOOR( RAND() * (9999-1000) + 1000));

#-------Student table insertion------------#
INSERT INTO student(studentID,dOB,gender,availableBalance) 
  VALUES (293779,'1997-07-11',TRUE,250);
INSERT INTO student(studentID,dOB,gender,availableBalance) 
  VALUES (29000,'1998-10-11',TRUE,500);
INSERT INTO student(studentID,dOB,gender,availableBalance) 
  VALUES (27865,'1991-11-11',TRUE,500);
INSERT INTO student(studentID,dOB,gender,availableBalance) 
  VALUES (25789,'1996-11-11',TRUE,500);
INSERT INTO student(studentID,dOB,gender,availableBalance) 
  VALUES (25432,'1995-12-11',FALSE,500); /*False for female*/

#-------Staff table insertion------------#
INSERT INTO staff(staffID) VALUES (52354);
INSERT INTO staff(staffID) VALUES (59021);
INSERT INTO staff(staffID) VALUES (53270);

#-------Admin table insertion------------#
INSERT INTO admin(adminID) VALUES (4561);

#-------Course table insertion------------#
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT111", "BCs Computer Science", "Information Technology", "Full_Time",'4', "2017-09-05", "2018-06-30","2017/2018");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT112", "BCs Computer Science", "Information Technology", "Part_Time", '4', "2017-09-05", "2018-06-30","2017/2018");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEMNG001", "BCs Mechanical Engineering", "Mechanical Engineering", "Full_Time", '4', "2017-09-05", "2018-06-30","2017/2018");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEHAIR001", "BCs Hair and beauty", "Hair and beauty", "Full_Time", '4', "2018-09-05", "2017-06-30","2018/2018");
# - courseID is a gues here, based on new level
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT121", "BCs Computer Science", "Information Technology", "Full_Time",'5', "2018-09-05", "2019-06-30","2018/2019");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT122", "BCs Computer Science", "Information Technology", "Part_Time", '5', "2018-09-05", "2019-06-30","2018/2019");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEMNG011", "BCs Mechanical Engineering", "Mechanical Engineering", "Full_Time", '5', "2018-09-05", "2019-06-30","2018/2019");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEHAIR011", "BCs Hair and beauty", "Hair and beauty", "Full_Time", '5', "2018-09-05", "2019-06-30","2018/2019");
# - courseID is a gues here, based on new level
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT131", "BCs Computer Science", "Information Technology", "Full_Time",'6', "2019-09-05", "2020-06-30","2019/2020");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEBCSIT132", "BCs Computer Science", "Information Technology", "Part_Time", '6', "2019-09-05", "2020-06-30","2019/2020");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEMNG021", "BCs Mechanical Engineering", "Mechanical Engineering", "Full_Time", '6', "2019-09-05", "2020-06-30","2019/2020");
INSERT INTO course(courseID, courseTitle, courseSubject, courseType, courseLevel, courseStartDate, courseEndDate, courseYear)
VALUES ("HEHAIR021", "BCs Hair and beauty", "Hair and beauty", "Full_Time", '6', "2019-09-05", "2020-06-30","2019/2020");

#-------Department table insertion------------#
INSERT INTO department(departmentID,departmentName,departmentCampusName)
VALUES ("CompLincCol1001","Bishops building","Lincoln");
INSERT INTO department(departmentID,departmentName,departmentCampusName)
VALUES ("HairLincCol1111","Abbey building","Lincoln");
INSERT INTO department(departmentID,departmentName,departmentCampusName)
VALUES ("SiemensLincCol1002","Cathedral building","Lincoln");

#-------Student to course table insertion------------#
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT111",29000,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT112",293779,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG001",27865,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG001",25789,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEHAIR001",25432,"Continuing");  

INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT131",29000,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT132",293779,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG011",27865,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG011",25789,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEHAIR021",25432,"Continuing");  

INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT121",29000,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEBCSIT122",293779,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG021",27865,"Continuing");
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEMNG021",25789,"Continuing"); 
INSERT INTO studentToCourse(stcCourseID,stcStudentID,stcStudentStatus)
VALUES ("HEHAIR011",25432,"Continuing"); 

#-------Staff to department table insertion------------#
INSERT INTO staffToDepartment(stDepartmentID,stStaffID)
VALUES ("CompLincCol1001",52354);
INSERT INTO staffToDepartment(stDepartmentID,stStaffID)
VALUES ("HairLincCol1111",53270);
INSERT INTO staffToDepartment(stDepartmentID,stStaffID)
VALUES ("SiemensLincCol1002",59021);

#-------Bursary requests table insertion------------#
INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID,bRequestsJustification,bRequestsRequestDate,bRequestsStatus,bRequestsStudentRequest)
VALUES ("HEBCSIT111",52354,"Rasberry Pi for course work.","2019-10-01","Submitted",TRUE); /*Student request for rasberry Pi for full time computer course*/
INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID,bRequestsJustification,bRequestsRequestDate,bRequestsStatus,bRequestsStudentRequest)
VALUES ("HEBCSIT112",52354,"Replacement of my broken keyboard","2019-01-01","Submitted",TRUE); /*Student request for computer keyboard for part time computer course*/
INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID,bRequestsJustification,bRequestsRequestDate,bRequestsStatus,bRequestsStaffRequest)
VALUES ("HEMNG001",59021,"Spanner for each student.","2019-01-01","Submitted",TRUE); /*Staff request for bulk order for mechanical engineering course for 2 people*/ 
INSERT INTO bursaryRequests(bRequestsCourseID,bRequestsStaffID,bRequestsJustification,bRequestsRequestDate,bRequestsStatus,bRequestsStudentRequest)
VALUES ("HEHAIR001",53270,"Shampoo and hair brush for practicals.","2019-01-01","Submitted",TRUE); /*Student reqeust for hair and beauty course 2 items*/

#-------Bursary request items table insertion------------#
/*Bursary funds can be spent on any of the following:
Additional qualifications (eg. FA Level 1, First Aid, Level 2 Safeguarding)
Professional accreditation or membership (eg. Guild of Photographers, STA) 
CPD workshops or events (eg. Therapy Expo, Guest speakers, industry visits)
Vocational placements Equipment and resources* (eg. Books, uniform, IT*/
INSERT INTO bursaryRequestItems(brItemCategory,brItemDesc,brItemURL,brItemPrice)
VALUES("Equipment and resources","Small computer for practical work with subnetting.","https://www.amazon.co.uk/dp/B07BR61P39/ref=asc_df_B07BR61P3958142109/?tag=googshopuk-21&creative=22146&creativeASIN=B07BR61P39&linkCode=df0&hvadid=310876754081&hvpos=1o1&hvnetw=g&hvrand=17419777916425967809&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1006876&hvtargid=pla-565320237828",64.99);
INSERT INTO bursaryRequestItems(brItemCategory,brItemDesc,brItemURL,brItemPrice)
VALUES("Equipment and resources","New computer keyboard","https://www.amazon.co.uk/dp/B00M75WPKO/ref=asc_df_B00M75WPKO58142109/?tag=googshopuk-21&creative=22146&creativeASIN=B00M75WPKO&linkCode=df0&hvadid=310665672682&hvpos=1o2&hvnetw=g&hvrand=3873864805278938592&hvpone=&hvptwo=&hvqmt=&hvdev=c&hvdvcmdl=&hvlocint=&hvlocphy=1006876&hvtargid=pla-563720906553",9.99);
INSERT INTO bursaryRequestItems(brItemCategory,brItemDesc,brItemURL,brItemPrice)
VALUES("Equipment and resources","14mm spanner.","https://www.zoro.co.uk/shop/hand-tools/combination-spanners/e113209-combination-wrench-14mm/ps/ZT1198424X?utm_campaign=pla-Hand+Tools+-+&utm_source=google&utm_medium=shopping-pla&utm_keyword=ZT1198424X&istCompanyId=6aa6787b-063e-4414-802d-129f235df603&istItemId=-xltmwwpilt&istBid=tztx&gclid=Cj0KCQiA-c_iBRChARIsAGCOpB09ItVE_Kh6RvDnouew8YIryRchbBvBIeEiRaK_Haf53iLw5-M-mBkaAqDzEALw_wcB",5.79);
INSERT INTO bursaryRequestItems(brItemCategory,brItemDesc,brItemURL,brItemPrice)
VALUES("Equipment and resources","High quality shampoo","https://www.hairproductsonline.co.uk/krissell-high-protein-luxury-apple-shampoo-5-litre.html?gclid=Cj0KCQiA-c_iBRChARIsAGCOpB0zMIhhqMaZvJxEeLXV1AM-04AIP_kV2aD-NYCoCavxkj7ISxm0Fm0aAtWwEALw_wcB",15.49);
INSERT INTO bursaryRequestItems(brItemCategory,brItemDesc,brItemURL,brItemPrice)
VALUES("Equipment and resources","Hair brush","https://www2.hm.com/en_gb/productpage.0428290001.html?gclid=Cj0KCQiA-c_iBRChARIsAGCOpB1ZiLb0Xc4LWHuM6jssuUYUEd2poiJtZkqRbn9tTGC2DYax1BJXdUYaAkGYEALw_wcB&ef_id=Cj0KCQiA-c_iBRChARIsAGCOpB1ZiLb0Xc4LWHuM6jssuUYUEd2poiJtZkqRbn9tTGC2DYax1BJXdUYaAkGYEALw_wcB:G:s&s_kwcid=AL!850!3!316451590004!!!g!582526225888!#modal-1",6.99);

#-------Items and requests table insertion------------#
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
VALUES(1,1,29000);
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID,StaffItemApproved)/*Staff approved*/
VALUES(2,2,293779,"Yes");
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID,StaffItemApproved)/*Staff approved because of bulk order from staff*/
VALUES(3,3,27865,"Yes");
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID,StaffItemApproved)/*Staff approved because of bulk order from staff*/
VALUES(3,3,25789,"Yes");
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
VALUES(4,4,25432);
INSERT INTO itemsAndRequests(ItemID,RequestID,StudentID)
VALUES(5,4,25432);

#-------Departments,Staff,Course and Students table insertion------------#
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,29000,"HEBCSIT111");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,293779,"HEBCSIT112");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,27865,"HEMNG001");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,25789,"HEMNG001"); 
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("HairLincCol1111",53270,25432,"HEHAIR001");  

INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,29000,"HEBCSIT131");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,293779,"HEBCSIT132");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,27865,"HEMNG011");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,25789,"HEMNG011");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("HairLincCol1111",53270,25432,"HEHAIR021");

INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,29000,"HEBCSIT121");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("CompLincCol1001",52354,293779,"HEBCSIT122");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,27865,"HEMNG021");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("SiemensLincCol1002",59021,25789,"HEMNG021");
INSERT INTO departmentsStaffCourseStudents(bscsDepartmentID,bscsStaffID,bscsStudentID,bscsCourseID)
VALUES("HairLincCol1111",53270,25432,"HEHAIR011");
# --END-- #