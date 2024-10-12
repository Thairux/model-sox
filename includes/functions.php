<?php
function getModels() {
    global $conn;
    $sql = "SELECT * FROM models";
    $result = $conn->query($sql);
    $models = array();
    while($row = $result->fetch_assoc()) {
        $models[] = $row;
    }
    return $models;
}

function getAgencies() {
    global $conn;
    $sql = "SELECT * FROM agencies";
    $result = $conn->query($sql);
    $agencies = array();
    while($row = $result->fetch_assoc()) {
        $agencies[] = $row;
    }
    return $agencies;
}

function getBookings() {
    global $conn;
    $sql = "SELECT * FROM bookings";
    $result = $conn->query($sql);
    $bookings = array();
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
    return $bookings;
}