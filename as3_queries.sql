#Select courses queries
#=======================

#Passed parameters:  OfferingDeptName , InstructorName, Start Semester, End Semester, start year , end year

#1. Find all courses offered by department 'D'	(D given)
	Select Courses_Course_ID from Department_has_Courses where Department_Short_Name='D'; 

#2. Find all courses tought by instructor 'I' with ID=IID	(I given)
	Select DISTINCT Courses_Course_ID, Semester, Year from Offered_Courses where Instructor_Instructor_ID=IID;

#3. Find all courses offered after start semester S, start year (SS SY given)
	Select Courses_COurse_ID, Semester, Year from Offered_courses where Year>Y OR (year=Y AND semester>=S);

#4. Find all courses offered before end semester S, end year Y (ES EY given)
	Select Courses_COurse_ID, Semester, Year from Offered_courses where Year<Y OR (year=Y AND semester<=S);

#5. Find all courses offered between start semester, year and end semester, year (SS SY ES EY given)
	Select Courses_COurse_ID, Semester, Year from Offered_courses where (Year<EY OR (year=EY AND semester<=ES)) AND (Year>SY OR (year=SY AND semester>=SS));;

#6 Courses offered by D and tought by I with ID=IID (D I given)
	Select OC.Courses_Course_ID, OC.Semester, OC.Year from Department_has_course DC, Offered_courses OC
		where DC.Department_Short_Name='D' 
		AND DC.Courses_Course_ID=OC.Courses_Course_ID 
		AND OC.Instructor_Instructor_ID=IID;
#7 