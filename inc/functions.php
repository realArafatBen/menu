<?php
# General alert function
function alert($msg, $type){
	echo '<div class="notification '.$type.' closeable">
	<p>'.$msg.'</p> <a class="close" href="#"></a>
	</div>';
}

# Active Menu ======================
function activemenu($eq){
$pg=basename($_SERVER['PHP_SELF']);	
	if($pg==$eq){echo 'active';}
}

# Get col name using id
function getNmById($table, $id, $colnm){
	global $con;
	$query = $con->query('SELECT * FROM '.
			$table.' WHERE id="'.$id.'"');
	while($row = $query->fetch()){
		return $row[$colnm]; 
	}
}

# Get email using deptID
function getColByDeptID($table, $deptID, $colnm){
	global $con;
	$query = $con->query('SELECT * FROM '.$table
	.' WHERE gem = 1 AND dept="'.$deptID.'" LIMIT 1');
	while($row = $query->fetch()){
		return $row[$colnm]; 
	}
}
# Record Count function
function countRec($table, $status){
	global $con;
	$query = $con->prepare('SELECT * FROM '.
	$table.' WHERE status='.$status );
	$query->execute(array()); 
	return $query->rowCount();			
}

# Pending post count function =================================
function pendingPostCount(){
	global $con, $yrdept;
	$query = $con->prepare('SELECT * FROM issues 
	WHERE from_dept= '. $yrdept .' AND status=0');
	$query->execute(array()); return $query->rowCount();			
}

# Resolve  task count function
function resolvedIssueCount(){
	global $con, $yrdept;
	$query = $con->prepare('SELECT * FROM issues 
	WHERE to_dept= '. $yrdept .' AND status=1');
	$query->execute(array()); return $query->rowCount();			
}
# =============================================================

function pendingResolveCount(){
	global $con, $yrdept;
	$query = $con->prepare('SELECT * FROM issues 
	WHERE to_dept= '. $yrdept .' AND status=0');
	$query->execute(array()); return $query->rowCount();			
}

function isResolvedCount(){
	global $con, $yrdept;
	$query = $con->prepare('SELECT * FROM issues 
	WHERE from_dept= '. $yrdept .' AND status=1');
	$query->execute(array()); return $query->rowCount();			
}

function checkIfLove($id){
	if (isset($_COOKIE['menu_love'])) {
        $cookie_data = stripcslashes($_COOKIE['menu_love']);
        $data = json_decode($cookie_data, true);
		if (in_array($id, $data) ) {
			return true;
		}else{
			return false;
		}
    }else{
		return false;
    }
}
?>