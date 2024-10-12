<?php
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Fetch data from database
$models = getModels();
$agencies = getAgencies();
$bookings = getBookings();

// Include views
require_once 'views/models.php';
require_once 'views/agencies.php';
require_once 'views/bookings.php';