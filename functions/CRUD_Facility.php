<?php
// Include database connection
//require_once 'connection.php';


// Function to create a new facility
function createFacility($facilityName, $address, $city, $province, $postalCode, $phoneNumber, $webAddress, $facilityType, $capacity) {
    require_once 'connection.php';
    //global $conn_pdo; 

    $sql = "INSERT INTO Facilities 
                            (FacilityName, Address, City, Province, PostalCode, FacilityPhoneNumber, WebAddress, FacilityType, Capacity) 
                            VALUES (:facilityName, :address, :city, :province, :postalCode, :phoneNumber, :webAddress, :facilityType, :capacity)";
    
    $data = $conn_pdo->prepare($sql);
    $data->bindParam(':facilityName', $facilityName);
    $data->bindParam(':address', $address);
    $data->bindParam(':city', $city);
    $data->bindParam(':province', $province);
    $data->bindParam(':postalCode', $postalCode);
    $data->bindParam(':phoneNumber', $phoneNumber);
    $data->bindParam(':webAddress', $webAddress);
    $data->bindParam(':facilityType', $facilityType);
    $data->bindParam(':capacity', $capacity);

    //return and close connection
    if ($data->execute()) {
        //$conn_pdo->query('KILL CONNECTION_ID()');
        echo "Added successfully!";
        $conn_pdo = null;
    }
    else {
        $conn_pdo = null;
        echo "<script>alert('Attempting to add facility.....'); window.location.href = 'displayFacility.php';</script>";
    }
}


// Function to update a facility
function updateFacility($id, $name, $address, $city, $province, $postalCode, $phoneNumber, $webAddress, $type, $capacity) {
    require_once 'connection.php';

    $sql = "UPDATE Facilities SET FacilityName='$name', Address='$address', City='$city', Province='$province', PostalCode='$postalCode', 
            FacilityPhoneNumber='$phoneNumber', WebAddress='$webAddress', FacilityType='$type', Capacity=$capacity WHERE FacilityID=$id";
    
    $data = $conn_pdo->prepare($sql);

    $data->bindParam(':facilityName', $name);
    $data->bindParam(':address', $address);
    $data->bindParam(':city', $city);
    $data->bindParam(':province', $province);
    $data->bindParam(':postalCode', $postalCode);
    $data->bindParam(':phoneNumber', $phoneNumber);
    $data->bindParam(':webAddress', $webAddress);
    $data->bindParam(':facilityType', $type);
    $data->bindParam(':capacity', $capacity);

    if ($data->execute()) {
        $conn_pdo = null;
        return "Facility updated successfully";
    } else {
        $conn_pdo = null;
        return "Attempting to update facility... " ;
    }
}

// Function to delete a facility
function deleteFacility($id) {
    require_once 'connection.php';

    $sql = "DELETE FROM Facilities WHERE FacilityID=:id";
    $statement = $conn_pdo->prepare($sql);
    
    $statement->bindParam(':id', $id);
    if ($statement->execute()) {
        $conn_pdo = null;
        return "Facility deleted successfully";
    } else {
        $conn_pdo = null;
        return "Attempting to delete facility...";
    }
}