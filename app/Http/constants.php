<?php

define('DATE_FORMAT', "d-m-Y h:i A");

//////////////Bookings Status////////////////////////////////////////
class BOOKING {
	const REQUESTED = 0;
	const ACCEPTED = 1;
	const SIGN_BY_CLIENT =  2;
	const SIGN_BY_OWNER = 3;
	const ACTIVE = 4;
	const EARLY_TERMINATION_REQUESTED = 5;
	const EARLY_TERMINATION_APPROVED = 6;
	const EXTEND_REQUESTED = 7;
	const EXTEND_APPROVED = 8;
	const CLOSED = 9;
	const DISPUTED = 10;
	const DISPUTE_RESOLVED = 11;
	const DEPOSIT_RETURNED = 12;
}
////////////Booking Status////////////////////////////////////////
