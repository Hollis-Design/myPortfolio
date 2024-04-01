<?php

/* 
 * ACCOUNTS MODEL
 */



/* Function to handle site registration */
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
  $db = acmeConnect();
  
  //The SQL Statement
  $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword) VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
  
  //Create the prepared statement using the using the acme connection
  $stmt = $db->prepare($sql);
  //Replace placeholders with actual data
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  
  //Execute the database request
  $stmt->execute();
  //Ask how many rows changed as a result of our insert
  $rowsChanged = $stmt->rowCount();
  //Close the database interaction
  $stmt->closeCursor();
  //Return indicator of success:
  return $rowsChanged;
  
}

//Check for an existing email in database
//Returns 0 if no existing email is found in database
//Returns 1 if email already exists in database
function checkDuplicateEmail($proposedEmail){
  $db = acmeConnect();
  
 $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :proposedEmail';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':proposedEmail', $proposedEmail, PDO::PARAM_STR);
 $stmt->execute();
 $emailList = $stmt->fetch(PDO::FETCH_NUM);
 $stmt->closeCursor();

 if(empty($emailList))
 {   
   return 0;
 }
 else
 {  
   return 1;
 }
}

function getClient($clientEmail){
 $db = acmeConnect();
 $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword 
         FROM clients
         WHERE clientEmail = :email';
 $stmt = $db->prepare($sql);
 $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
 $stmt->execute();
 $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt->closeCursor();
 return $clientData;
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId)
{
  $db = acmeConnect();
  $sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
  $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
  $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  
  return $rowsChanged;
}

function updateClientPwd($clientPassword, $clientId)
{
  $db = acmeConnect();
  $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  
  return $rowsChanged;
}

function getClientInfo($clientId)
{
  $db = acmeConnect();
  $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
  $stmt->execute();
  $client = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $client;
}

