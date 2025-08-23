<?php
// Database connection function
function getDBConnection()
{
	$con = new mysqli('localhost', 'root', '', 'habesha_bank');
	if ($con->connect_error) {
		die("Database connection failed: " . $con->connect_error);
	}
	return $con;
}

// Function to sanitize inputs
function sanitizeInput($data)
{
	return htmlspecialchars(stripslashes(trim($data)));
}

// User account process
function setBalance($amount, $process, $accountNo)
{
	$con = getDBConnection();
	$accountNo = sanitizeInput($accountNo);

	// Use prepared statements to prevent SQL injection
	$stmt = $con->prepare("SELECT deposit FROM useraccounts WHERE accountNo = ?");
	$stmt->bind_param("s", $accountNo);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($row = $result->fetch_assoc()) {
		$deposit = $row['deposit'];
		if ($process === 'credit') {
			$newDeposit = $deposit + $amount;
		} else {
			$newDeposit = $deposit - $amount;
		}

		$stmt = $con->prepare("UPDATE useraccounts SET deposit = ? WHERE accountNo = ?");
		$stmt->bind_param("is", $newDeposit, $accountNo);
		return $stmt->execute();
	}

	$stmt->close();
	return false;
}

// Other account process
function setOtherBalance($amount, $process, $accountNo)
{
	$con = getDBConnection();
	$accountNo = sanitizeInput($accountNo);

	// Use prepared statements to prevent SQL injection
	$stmt = $con->prepare("SELECT deposit FROM otheraccounts WHERE accountno = ?");
	$stmt->bind_param("s", $accountNo);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($row = $result->fetch_assoc()) {
		$deposit = $row['deposit'];
		if ($process === 'credit') {
			$newDeposit = $deposit + $amount;
		} else {
			$newDeposit = $deposit - $amount;
		}

		$stmt = $con->prepare("UPDATE otheraccounts SET deposit = ? WHERE accountno = ?");
		$stmt->bind_param("is", $newDeposit, $accountNo);
		return $stmt->execute();
	}

	$stmt->close();
	return false;
}

// Transaction function
function makeTransaction($action, $amount, $other)
{
	$con = getDBConnection();
	$sessionUserId = isset($_SESSION['userid']) ? intval($_SESSION['userid']) : 0;

	// Use prepared statements to prevent SQL injection
	$stmt = $con->prepare("INSERT INTO transaction (action, debit, otherAccount, userid) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("sssi", $action, $amount, $other, $sessionUserId);
	return $stmt->execute();
}

// Cashier transaction function
function makeTransactionCashier($action, $amount, $other, $userid)
{
	$con = getDBConnection();
	$userid = intval($userid); // Ensure $userid is an integer

	// Use prepared statements to prevent SQL injection
	$stmt = $con->prepare("INSERT INTO transaction (action, debit, otherAccount, userid) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("sssi", $action, $amount, $other, $userid);
	return $stmt->execute();
}