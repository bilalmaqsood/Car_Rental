<?php

return [

    'minimum' => 'Booking cannot be less than one week.',

    'exist' => ':vehicle\'s booking for these date\'s already exist.',
    'create' => 'Booking created successfully for :vehicle.',

    'unauthenticated' => 'Booking is not associated to :name.',

    'delete' => 'Booking is deleted which is associated to :name.',

    'booked' => ':vehicle is already booked on these dates.',
    'not-match' => 'These dates are not available for booking.',

    'requested' => 'Driver (:user) want to :status the booking.',

    'fulfilled' => 'Owner (:user) has updated the booking as :status.',

    'log-fulfilled' => 'Owner (:user) has already updated the booking as :status.',

    'deposit' => 'Your balance is insufficient for vehicle booking and also you do not have any default credit card.',

    'in-progress' => 'You cannot give feedback because booking is not close.',

    'sign' => 'You cannot sign booking contract because booking is <b>:status</b>.',

    'signature' => 'Successfully contract signed by :name.',

    'feedback' => [
        'exist' => 'Feedback is already exist for current booking.',
    ],

];
