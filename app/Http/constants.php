<?php

	define('DATE_FORMAT', "d.m.Y");

	define('OWNER_REMINDER_INTERVAL', 5);
	define('DRIVER_REMINDER_INTERVAL', 5);
	define('BOOKING_REMINDER_ATTEMPTS_LIMIT', 4);
	define('BOOKING_ENDING_REMINDER_INTERVAL', 24); //Enter booking ending reminder time interval in hours


//////////////Bookings Status////////////////////////////////////////

	define('BOOKING_REQUESTED',0);
	define('BOOKING_ACCEPTED',1);
	define('BOOKING_SIGN_BY_CLIENT',2);
	define('BOOKING_SIGN_BY_OWNER',3);
	define('BOOKING_ACTIVE',4);
	define('BOOKING_EARLY_TERMINATION_REQUESTED',5);
	define('BOOKING_EARLY_TERMINATION_APPROVED',6);
	define('BOOKING_EXTEND_REQUESTED',7);
	define('BOOKING_EXTEND_APPROVED',8);
	define('BOOKING_CLOSED',9);
	define('BOOKING_DISPUTED',10);
	define('BOOKING_DISPUTE_RESOLVED',11);
	define('BOOKING_DEPOSIT_RETURNED',12);
	define('BOOKING_UNSUCCESSFULL',400);
	define('BOOKING_UNRESPONSIVE',401);
	define('BOOKING_PENDING',402);
	define('BOOKING_AMENDED',416);
	define('BOOKING_ENDING',417);
	define('VEHICLE_DISPUTED',410);
	define('INSPECTION_COMPLETED',201);
	define('INSPECTION_CODE_GENERATED',202);
	define('INSPECTION_OPEN',203);
	define('INSPECTION_CONFIRMED',204);
	define('DISPUTED_RESOLVED',205);
	

////////////Booking Status////////////////////////////////////////
