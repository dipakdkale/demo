<?php

class Student {
	var $first_name;
	var $last_name;
	var $country = 'none';

	function say_hello() {
		return 'hello world!';
	}


}

$student1 = new Student;
$student1 -> first_name = 'Dipak';
$student1-> last_name= 'Kale';


$student2 = new student;
$student2 -> first_name = 'Pooja';
$student2 -> last_name = 'Kale';

echo $student1-> first_name. "". $student1-> last_name ."<br/>";
echo $student2-> first_name. "". $student2-> last_name ."<br/>";

echo student1  ;
echo student2  ;

$class_vars =get_class_methods('Student');
echo "Class methods:" .implode(',', $class_methods). "<br />"	;

if (method_exists('student', 'say_hello')){
	echo "Method say_hello () exists in student class.<br/>";
} else {
	echo "Method say_hello () does not exists in student class.<br/>";
}

?>
