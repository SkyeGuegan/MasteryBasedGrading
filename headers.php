<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
    <title>Mastery Grading</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="style.css">

<style>

.menu {
    font-family: sans-serif;
}

.menu ul{
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

.menu li {
  float: left;
}

.menu li a, .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.menu li a:hover, .dropdown:hover .dropbtn {
  background-color: #800000; 
}

.menu li a:active{
  background-color: #7CBF70;
}

.menu li.dropdown {
  display: inline-block;
}

.menu .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  z-index: 1;
}

.menu .dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.menu .dropdown:hover .dropdown-content {
  display: block;
}

.menu .dropdown-content a:hover {background-color: #f1f1f1;}



.to-right {
  float: right;
}


</style>
</head>
<body>
  <div class="menu">
<ul>
  <li><a href="http://129.114.104.163/~dbteam/index.php">Home</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Student</a>
    <div class="dropdown-content">
      <a href="http://129.114.104.163/~dbteam/viewStudents.php">View Students</a>
      <a href="http://129.114.104.163/~dbteam/addStudent.php">Add a Student</a>
      <a href="http://129.114.104.163/~dbteam/importStudentsFile.php" >Import Students</a>
    </div>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Quiz</a>
    <div class="dropdown-content">
      <a href="http://129.114.104.163/~dbteam/createQuiz.php" >Create A Quiz</a>
      <a href="http://129.114.104.163/~dbteam/quizQuestions.php" >Add Quiz Questions</a>
      <a href="http://129.114.104.163/~dbteam/viewQuiz.php" >View Quizzes</a>
    </div>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Grade</a>
    <div class="dropdown-content">
      <a href="http://129.114.104.163/~dbteam/QuizInfo2.0.php">Grade Students</a>
      <a href="http://129.114.104.163/~dbteam/viewGrades.php" >View Grades</a>
      <a href="http://129.114.104.163/~dbteam/MasteryCompletionTable.php">Mastery Completion Table</a>
    </div>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Misc</a>
    <div class="dropdown-content">
      <a href="http://129.114.104.163/~dbteam/viewLT.php">View Learning Targets</a>
    </div>
  </li>
  <div class="to-right">
  	<li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">End of Semester</a>
    <div class="dropdown-content">
      <a href="exportData.php">Export Data</a>
      <a href="clearData.php">Clear Data</a>
    </div>
  </li>
  <li class="logout"><a href="http://129.114.104.163/~dbteam/logout.php" class="pull-right">Logout</a></li>
  </div>
</ul>
</div>

</body>
</html>
