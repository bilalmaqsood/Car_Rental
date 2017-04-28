<?php


/**
 * @api {post} /auth 2.0.0 Owner Login
 * @apiName 1.0 Owner Login
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 *
 * @apiParam {String} username User email or Phone.
 * @apiParam {String} password User password.
 *
 * @apiSuccess {String} token Login token for User.
 * @apiSuccess {String} type Logged in User type.
 *
 * @apiSampleRequest /auth
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "success": {
 *          "token": "yJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0a",
 *          "type": "owner"
 *       }
 *     }
 */

/**
 * @api {post} /account 3.1.0 Add Bank Info
 * @apiName AddBankInfo
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 * @apiHeader {String} Authorization User token 'Bearer 2NWZmNTNhZjEwNmMxMmZmZmNlNGY0MzY'.
 *
 * @apiParam {String} title  Account Holder Name.
 * @apiParam {String} number Account Number.
 * @apiParam {String} sortcode Sort Code.
 *
 * @apiSampleRequest /account
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "success": "A new account has been added for Qwikkar."
 *     }
 */

/**
 * @api {get} /account 3.1.0 Get all bank accounts
 * @apiName GetBankInfo
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Authorization User token 'Bearer 2NWZmNTNhZjEwNmMxMmZmZmNlNGY0MzY'.
 *
 * @apiSampleRequest /account
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "success": [
 *              {
 *                  "id": 2,
 *                  "title": "Nasir Mehmood",
 *                  "number": "0123456733389",
 *                  "sortcode": "665464444464",
 *                  "created_at": "2017-04-27 11:34:30",
 *                  "updated_at": "2017-04-27 11:36:53"
 *              }
 *         ]
 *     }
 */

/**
 * @api {get} /account/2 3.1.0 Get a bank's account info
 * @apiName GetAnAccountInfo
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Authorization User token 'Bearer 2NWZmNTNhZjEwNmMxMmZmZmNlNGY0MzY'.
 *
 * @apiSampleRequest /account/2
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "success": {
 *             "id": 2,
 *             "title": "Nasir Mehmood",
 *             "number": "0123456733389",
 *             "sortcode": "665464444464",
 *             "created_at": "2017-04-27 11:34:30",
 *             "updated_at": "2017-04-27 11:36:53"
 *         }
 *     }
 */

/**
 * @api {patch} /account/1 3.1.0 Update a bank's account info
 * @apiName UpdateAnAccountInfo
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 * @apiHeader {String} Authorization User token 'Bearer 2NWZmNTNhZjEwNmMxMmZmZmNlNGY0MzY'.
 *
 * @apiParam {String} title  Account Holder Name.
 * @apiParam {String} number Account Number.
 * @apiParam {String} sortcode Sort Code.
 *
 * @apiSampleRequest /account/2
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "success": {
 *             "id": 2,
 *             "title": "Nasir Mehmood",
 *             "number": "0123456733389",
 *             "sortcode": "665464444464",
 *             "created_at": "2017-04-27 11:34:30",
 *             "updated_at": "2017-04-27 11:36:53"
 *         }
 *     }
 */

/**
 * @api {delete} /account/1 3.1.0 Remove a bank's account info
 * @apiName RemoveAnAccountInfo
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Authorization User token 'Bearer 2NWZmNTNhZjEwNmMxMmZmZmNlNGY0MzY'.
 *
 * @apiSampleRequest /account/2
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *         "success": "Qwikkar's account has been deleted."
 *     }
 */

/**
 * @api {post} /register/owner 2.1.0 Owner Sign Up
 * @apiName Owner Sign Up
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 *
 * @apiParam {String} first_name First name of the User.
 * @apiParam {String} last_name  Last name of the User.
 * @apiParam {String} company    Company Name.
 * @apiParam {String} email      Email of the User.
 * @apiParam {String} phone      Phone of the User.
 * @apiParam {String} password   Password of user.
 * @apiParam {String} address    Property number and address of user.
 * @apiParam {String} street     Trading street address of user.
 * @apiParam {String} town       Trading street address of user.
 * @apiParam {String} postcode   Trading postcode address of user.
 * @apiParam {String} country    Trading country address of user.
 * @apiParam {String} promoCode  Promo Code (someone invited him/her)(New)
 *
 * @apiSuccess {String} token    Token for registered user.
 *
 * @apiSampleRequest /register/owner
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "success": "yJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0a"
 *     }
 */

/**
 * @api {get} /terms/owner 2.1.1 Terms & Conditions
 * @apiName OwnerTermsConditions
 * @apiGroup Owner
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 *
 * @apiSuccess {String} terms Terms & Conditions Long Text.
 *
 * @apiSampleRequest /terms/owner
 */


/**
 * @api {post} /Owner/addvehicle/ 2.2.0 Add Vehicle
 * @apiName AddVehicle
 * @apiGroup Owner Vehicles
 *
 * @apiParam {String} make  Make of vehicle.
 * @apiParam {String} model model of vehicle.
 * @apiParam {String} variant variant of vehicle.
 * @apiParam {String} year Year of vehicle.
 * @apiParam {String} mileage Mileage of vehicle.
 * @apiParam {String} fuel Fuel type of vehicle.
 * @apiParam {String} mpg Fuel cosumption.
 * @apiParam {String} transmission  Transmission of vehicle.
 * @apiParam {String} seats Number of seats.
 * @apiParam {String} availablefrom Available Date Start.
 * @apiParam {String} availableto Available Date End.
 * @apiParam {String} pickup Yes / No if pick by owner.
 * @apiParam {String} delivery Yes / No if delivery by owner.
 * @apiParam {String} location Vehicle Pickup location.
 * @apiParam {Number} deliverycharges Delivery vharges per mile.
 * @apiParam {Number} rent Rent Per Week
 * @apiParam {Number} insurance Insurance Per Week
 * @apiParam {Number} milecap Mileage Cap per week
 * @apiParam {Number} aftermile after mileage per mile price
 * @apiParam {Object[]} deposit Deposit
 * @apiParam {Json[]} discounts [{value:15,percent:15,weeks:2}]
 * @apiParam {Object[]} uberdiscount [{value:15,percent:15,range:<4.4}]
 * @apiParam {Images[]} images all images
 * @apiParam {Images[]} Car Documents
 * @apiParam {Number} extension Contract Extension Weeks
 * @apiParam {Number} licenseyears License Older Than Years
 * @apiParam {Number} pcoyears PCO License older than years
 * @apiParam {Number} driveryear Driver Older than years
 * @apiParam {Number} licensepoints Maximum points on license
 * @apiParam {Number} nofaultaccident Years since last accident with no driver fault
 * @apiParam {Number} faultaccident Years since last accident with driver fault
 *
 * @apiSuccess {Number} id    Vehicle ID.
 */



/**
 * @api {get} /Owner/vehicle/ 3.1.0 Get Vehicle
 * @apiName GetVehicles
 * @apiGroup Owner Vehicles
 *
 * @apiParam {Number} id  Owner ID.
 *
 * @apiSuccess {String} make  Make of vehicle.
 * @apiSuccess {String} model model of vehicle.
 * @apiSuccess {String} variant variant of vehicle.
 * @apiSuccess {String} year Year of vehicle.
 * @apiSuccess {String} mileage Mileage of vehicle.
 * @apiSuccess {String} fuel Fuel type of vehicle.
 * @apiSuccess {String} mpg Fuel cosumption.
 * @apiSuccess {String} transmission  Transmission of vehicle.
 * @apiSuccess {String} seats Number of seats.
 * @apiSuccess {String} availablefrom Available Date Start.
 * @apiSuccess {String} availableto Available Date End.
 * @apiSuccess {String} pickup Yes / No if pick by owner.
 * @apiSuccess {String} delivery Yes / No if delivery by owner.
 * @apiSuccess {String} location Vehicle Pickup location.
 * @apiSuccess {Number} deliverycharges Delivery vharges per mile.
 * @apiSuccess {Number} rent Rent Per Week
 * @apiSuccess {Number} insurance Insurance Per Week
 * @apiSuccess {Number} milecap Mileage Cap per week
 * @apiSuccess {Number} aftermile after mileage per mile price
 * @apiSuccess {Object[]} deposit Deposit
 * @apiSuccess {Json[]} discounts [{value:15,percent:15,weeks:2}]
 * @apiSuccess {Object[]} uberdiscount [{value:15,percent:15,range:<4.4}]
 * @apiSuccess {Images[]} images all images
 * @apiSuccess {Number} extension Contract Extension Weeks
 * @apiSuccess {Number} licenseyears License Older Than Years
 * @apiSuccess {Number} pcoyears PCO License older than years
 * @apiSuccess {Number} driveryear Driver Older than years
 * @apiSuccess {Number} licensepoints Maximum points on license
 * @apiSuccess {Number} nofaultaccident Years since last accident with no driver fault
 * @apiSuccess {Number} faultaccident Years since last accident with driver fault
 *
 *
 *
 *
 *
 * @apiSuccess {Object[]} Vehicles list
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [{
 *       "vid": 15,
 *       "vehicle":     "Toyota Prius 1.8 Hybrid"
 *       "candidate":   "John"
 *       "start":       "01.03.2017"
 *       "end":         "15.03.2017"
 *       "rented":      5
 *     }]
 * @apiSampleRequest /Owner/vehicle/
 */

/**
 * @api {patch} /Owner/vehicle/id 3.1.1 Update Vehicle (New)
 * @apiName UpdateVehicle
 * @apiGroup Owner Vehicles
 *
 * @apiParam {String} make  Make of vehicle.
 * @apiParam {String} model model of vehicle.
 * @apiParam {String} variant variant of vehicle.
 * @apiParam {String} year Year of vehicle.
 * @apiParam {String} mileage Mileage of vehicle.
 * @apiParam {String} fuel Fuel type of vehicle.
 * @apiParam {String} mpg Fuel cosumption.
 * @apiParam {String} transmission  Transmission of vehicle.
 * @apiParam {String} seats Number of seats.
 * @apiParam {String} availablefrom Available Date Start.
 * @apiParam {String} availableto Available Date End.
 * @apiParam {String} pickup Yes / No if pick by owner.
 * @apiParam {String} delivery Yes / No if delivery by owner.
 * @apiParam {String} location Vehicle Pickup location.
 * @apiParam {Number} deliverycharges Delivery vharges per mile.
 * @apiParam {Number} rent Rent Per Week
 * @apiParam {Number} insurance Insurance Per Week
 * @apiParam {Number} milecap Mileage Cap per week
 * @apiParam {Number} aftermile after mileage per mile price
 * @apiParam {Object[]} deposit Deposit
 * @apiParam {Json[]} discounts [{value:15,percent:15,weeks:2}]
 * @apiParam {Object[]} uberdiscount [{value:15,percent:15,range:<4.4}]
 * @apiParam {Images[]} images all images
 * @apiParam {Images[]} Car Documents
 * @apiParam {Number} extension Contract Extension Weeks
 * @apiParam {Number} licenseyears License Older Than Years
 * @apiParam {Number} pcoyears PCO License older than years
 * @apiParam {Number} driveryear Driver Older than years
 * @apiParam {Number} licensepoints Maximum points on license
 * @apiParam {Number} nofaultaccident Years since last accident with no driver fault
 * @apiParam {Number} faultaccident Years since last accident with driver fault
 *
 * @apiSuccess {Number} id    Vehicle ID.
 */

/**
 * @api {delete} /Owner/vehicle/vid 5.0.0 Remove Vehicle
 * @apiName remove Vehicle
 * @apiGroup Owner Vehicles
 * @apiParam {String} vid Vehicle ID.
 *
 * @apiSuccess {String} vehicle Vehicle has been removed successfully.
 * @apiError NotFound Not Found.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "No Vehicle found"
 *     }
 * @apiSampleRequest /Owner/vehicle/vid
 */

/**
 * @api {post} /Owner/contract/ 3.2.4 Add Contract
 * @apiName AddContract
 * @apiGroup Owner Contracts
 *
 * @apiParam {Number} oid    Owner ID
 * @apiParam {Number} cid    Vehicle ID
 * @apiParam {String} contract    Contract Text
 *
 */


/**
 * @api {post} /Owner/contract/ 3.2.0 Get Intent Contracts
 * @apiName GetIntentContracts
 * @apiGroup Owner Contracts
 *
 * @apiParam {Number} id    Owner ID
 *
 * @apiSuccess {Object[]} contracts Contracts
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [{
 *       "vid": 15,
 *       "vehicle":     "Toyota Prius 1.8 Hybrid"
 *       "candidate":   "John"
 *       "start":       "01.03.2017"
 *       "end":         "15.03.2017"
 *       "rented":      5
 *     }]
 */


/**
 * @api {post} /Owner/contract/ 3.2.1 Get Current Contracts
 * @apiName GetCurrentContracts
 * @apiGroup Owner Contracts
 *
 * @apiParam {Number} id    Owner ID
 *
 * @apiSuccess {Object[]} contracts Contracts
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [{
 *       "vid": 15,
 *       "vehicle":     "Toyota Prius 1.8 Hybrid"
 *       "driver":      "John"
 *       "start":       "01.03.2017"
 *       "end":         "15.03.2017"
 *       "cost":        140
 *       "status":      "Ongoing/Not Signed/Pending Approval"
 *       "pdf":         "http://path/to/pdf"
 *     }]
 */


/**
 * @api {post} /Owner/contract/ 3.2.5 Sign Contract
 * @apiName Sign Contract
 * @apiGroup Owner Contracts
 *
 * @apiParam {Number}   id    Owner ID
 * @apiParam {Image}    image    Owner Signed Image
 *
 * @apiSuccess {Object[]} contract Contract
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "vid": 15,
 *       "vehicle":     "Toyota Prius 1.8 Hybrid"
 *       "driver":      "John"
 *       "start":       "01.03.2017"
 *       "end":         "15.03.2017"
 *       "cost":        140
 *       "status":      "Ongoing/Not Signed/Pending Approval"
 *       "pdf":         "http://path/to/pdf"
 *     }
 */


/**
 * @api {post} /Owner/return/ 3.2.5 Add Vehicle Side Image
 * @apiName AddVehicleSideImage
 * @apiGroup Owner Return
 *
 * @apiParam {Number}   id    Owner ID
 * @apiParam {Image}    image    Vehicle Side Image
 * @apiParam {String}   side    Side Name (Front/Back/Left/Right/Top)
 *
 * @apiSuccess {String} success Added Successfully
 */

/**
 * @api {post} /Owner/return/ 3.2.5 Add Vehicle Return Summary
 * @apiName AddVehicleReturnSummary
 * @apiGroup Owner Return
 *
 * @apiParam {Number}   id    Owner ID
 * @apiParam {Image}    image    Vehicle Side Image
 * @apiParam {String}   text    text info
 *
 * @apiSuccess {String} success Added Successfully
 */


/**
 * @api {post} /Owner/return/ 3.2.5 Add Vehicle Return Docs
 * @apiName AddVehicleReturnDocs
 * @apiGroup Owner Return
 *
 * @apiParam {Number}   id      Owner ID
 * @apiParam {Image}    image    Doc Image
 *
 * @apiSuccess {String} success Added Successfully
 */


/**
 * @api {get} /Client/SearchMakeModel/ 2.0.1 Live Search Make Model
 * @apiName LiveSearchMakeModel
 * @apiGroup Client
 *
 * @apiParam {String} searchword    User typed word e.g. "T"
 *
 * @apiSuccess {Object} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       101: "Tata Motors",
 *       102: "Tesla",
 *       104: "Toyota"
 *     }
 */


/**
 * @api {get} /Client/SearchAddress/ 2.0.1 Live Search Address
 * @apiName LiveSearchAddress
 * @apiGroup Client
 *
 * @apiParam {String} searchword    User typed word e.g. "SW"
 *
 * @apiSuccess {Object} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       101: "Switzerland",
 *       102: "London SW1",
 *       103: "London SW11 4NJ"
 *     }
 */


/**
 * @api {post} /Client/Search/ 2.0.0 Search
 * @apiName Search
 * @apiGroup Client
 *
 * @apiParam {String} searchword    User typed word
 * @apiParam {String} longitude     User location longitude
 * @apiParam {String} latitude      User location latitude
 * @apiParam {String} pricemin      Minimum Price
 * @apiParam {String} pricemax      Maximum Price
 * @apiParam {String} bookingstart  Booking Start
 * @apiParam {String} bookingend    Booking End
 * @apiParam {String} yearmin       Minimum Feedback
 * @apiParam {String} yearmax       Maximum Feedback
 *
 * @apiSuccess {Object[]} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [{
 *       "vid": 15,
 *       "vehicle":         "Toyota Prius 1.8 Hybrid",
 *       "year":            2015,
 *       "miles":           34356,
 *       "seats":           5,
 *       "Transmission":    "manual",
 *       "address":         "45, King William Street, London, EC4r 9",
 *       "available":       "Now",
 *       "images":          ["http://path/to/image"],
 *       "notes":           "Insurance Included",
 *       "price":           "250"
 *     }]
 */


/**
 * @api {post} /Client/Search/ 2.1.1 Vehicle Detail
 * @apiName Vehicle Detail
 * @apiGroup Client
 *
 * @apiParam {Number} vid    vehicle ID
 *
 * @apiSuccess {Object[]} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "vid": 15,
 *       "vehicle":         "Toyota Prius 1.8 Hybrid",
 *       "year":            2015,
 *       "miles":           34356,
 *       "seats":           5,
 *       "Transmission":    "manual",
 *       "address":         "45, King William Street, London, EC4r 9",
 *       "available":       "Now",
 *       "images":          ["http://path/to/image"],
 *       "notes":           "Insurance Included",
 *       "price":           250
 *       "engine":          "1.8-litre hybrid e-CVT"
 *       "consumption":     84.2
 *       "economy":         94.5
 *       "pickup":          "45, King William Street, London, EC4r 9"
 *       "dropoff":         "45, King William Street, London, EC4r 9"
 *       "summary":         "A great vehicle to use as a taxi. Low consump on, very good looking"
 *       "owner":           "John Doe"
 *       "date":           "03.02.2017"
 *     }
 */


/**
 * @api {post} /Client/Search/ 2.1.1 Vehicle Book Invoice
 * @apiName VehicleBookInvoice
 * @apiGroup Client
 *
 * @apiParam {Number} vid       Vehicle ID
 * @apiParam {String} startdata Booking Start Date
 * @apiParam {String} enddate   Booking End Date
 * @apiParam {String} location  Address
 * @apiParam {String} promo     Promocode
 * @apiParam {String} enddate   Booking End Date
 *
 * @apiSuccess {Object[]} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "vid": 15,
 *       "vehicle":         "Toyota Prius 1.8 Hybrid",
 *       "year":            2015,
 *       "miles":           34356,
 *       "seats":           5,
 *       "Transmission":    "manual",
 *       "address":         "45, King William Street, London, EC4r 9",
 *       "available":       "Now",
 *       "images":          ["http://path/to/image"],
 *       "notes":           "Insurance Included",
 *       "price":           250
 *       "engine":          "1.8-litre hybrid e-CVT"
 *       "consumption":     84.2
 *       "economy":         94.5
 *       "pickup":          "45, King William Street, London, EC4r 9"
 *       "dropoff":         "45, King William Street, London, EC4r 9"
 *       "summary":         "A great vehicle to use as a taxi. Low consump on, very good looking"
 *       "owner":           "John Doe"
 *       "date":           "03.02.2017"
 *     }
 */


/**
 * @api {post} /register/client 3.1.0 Client Sign Up
 * @apiName ClientSignUp
 * @apiGroup Client
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 *
 * @apiParam {String} first_name First Name
 * @apiParam {String} last_name  Last Name
 * @apiParam {String} email      User Email
 * @apiParam {String} phone      User Phone Number
 * @apiParam {String} password   User Password
 * @apiParam {String} insurance  National Insurance Number
 * @apiParam {String} driving    Driving License Number
 * @apiParam {String} dvla       DVLA Points
 * @apiParam {String} postcode   Postcode on License
 * @apiParam {Date}   dob        Date of Birth
 * @apiParam {String} pcoNumber  PCO Certificate Number(New)
 * @apiParam {Date}   pcoRelDate PCO Release Date(New)
 * @apiParam {Date}   pcoExpDate PCO Expiry Date(New)
 * @apiParam {String} promoCode  Promo Code (someone invited him/her)(New)
 *
 * @apiSuccess {String} token    Token for registered User.
 *
 * @apiSampleRequest /register/client
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "success": "yJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0a"
 *     }
 */


/**
 * @api {post} /auth 3.1.1 Client Login
 * @apiName Client Login
 * @apiGroup Client
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 * @apiHeader {String} Content-Type Application accept content from request in form of 'application/json'.
 *
 * @apiParam {String} username User email or Phone.
 * @apiParam {String} password User password.
 *
 * @apiSuccess {String} token Login token for User.
 * @apiSuccess {String} type Logged in User type.
 *
 * @apiSampleRequest /auth
 *
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     {
 *       "success": {
 *          "token": "yJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0a",
 *          "type": "client"
 *       }
 *     }
 */


/**
 * @api {get} /terms/client 3.1.2 Terms & Conditions
 * @apiName ClientTermsConditions
 * @apiGroup Client
 *
 * @apiHeader {String} Accept API accept 'application/json'.
 *
 * @apiSuccess {String} terms Terms & Conditions Long Text.
 *
 * @apiSampleRequest /terms/client
 */


/**
 * @api {get} /Client/contract/ 4.1.0 Contract
 * @apiName ClientTermsConditions
 * @apiGroup Client
 *
 * @apiParam {Number} id    Client ID
 *
 * @apiSuccess {Object[]} result
 * @apiSuccessExample {json} Success-Response:
 *     HTTP/1.1 200 OK
 *     [{
 *       "id"        :    352,
 *       "name"    :    "Toyota Prius",
 *       "date"    :    "2017-03-21",
 *       "owner"    :    "John Doe",
 *       "ownerid"    :    15,
 *       "status"    :    "ongoing/past/pending",
 *       "pdf"        :    "http://www.pdf/path/to/contract/"
 *     }]
 */


/**
 * @api {get} /Client/contract/id/text 4.1.0 Contract
 * @apiName ClientTermsConditions
 * @apiGroup Client
 *
 * @apiParam {Number} id    Client ID
 * @apiParam {Number} vid    Vehcile ID
 *
 * @apiSuccess {String} contract   Contract Long Text.
 * @apiSuccess {String} cid   Contract ID.
 */


/**
 * @api {post} /Client/contract/id/sign 4.1.2 Contract Sign
 * @apiName ClientContractSign
 * @apiGroup Client
 *
 * @apiParam {Number} cid    Contract ID
 * @apiParam {Image}  sign    Sign Image
 *
 * @apiSuccess {String} pdf   Contract PDF.
 */


/**
 * @api {post} /Client/contract/id/decline/ 4.1.2 Contract Decline
 * @apiName ClientContractDecline
 * @apiGroup Client
 *
 * @apiParam {Number} cid    Contract ID
 *
 * @apiSuccess {String} pdf   Contract PDF.
 */


/**
 * @api {post} /Client/contract/id/pdf/ 4.1.2 Contract PDF
 * @apiName ClientContractPDF
 * @apiGroup Client
 *
 * @apiParam {Number} cid    Contract ID
 *
 * @apiSuccess {String} pdf   Contract PDF.
 */


/**
 * @api {post} /payment/card 5.0.0 Add Card
 * @apiName Add Card
 * @apiGroup Payment
 * @apiParam {String} mode Mode of payment {"paypal","card"}.
 * @apiParam {String} charge now Charge Card As Well Yes/No.
 * @apiParam {Number} amount Amount.
 * @apiParam {Json} payinfo  {
 *    "card": [{
 *        "number": "6543287643898765432",
 *        "name": "Name On Card",
 *        "cvv": 343,
 *        "expiry": "03/21",
 *        "address": "Address of User",
 *    }]
 * }
 *
 * @apiSuccess {String} card Your card has been added successfully.
 * @apiError PaymentNotConfirmed Payment Not Confirmed.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "Provided payment information is not working"
 *     }
 * @apiSampleRequest /payment/addcard
 */


/**
 * @api {get} /payment/card/id 5.0.0 Get Cards
 * @apiName Get Cards
 * @apiGroup Payment
 * @apiParam {String} id User ID.
 * @apiSuccessExample
 * {
 *    "cards": [{
 *        "id": "5",
 *        "number": "6543287643898765432",
 *        "name": "Name On Card",
 *        "expiry": "03/21",
 *        "address": "Address of User",
 *    }]
 * }
 *
 * @apiSuccess {String} payment payment recieved, Order confirmed.
 * @apiError NotFound Not Found.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "No cards found"
 *     }
 * @apiSampleRequest /payment/card/id
 */

/**
 * @api {delete} /payment/card 5.0.0 Remove Card
 * @apiName remove Card
 * @apiGroup Payment
 * @apiParam {String} cardid Card ID.
 *
 * @apiSuccess {String} card Card has been removed successfully.
 * @apiError NotFound Not Found.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "No cards found"
 *     }
 * @apiSampleRequest /payment/card
 */


/**
 * @api {patch} /payment/card 5.0.0 Edit Card
 * @apiName Edit Card
 * @apiGroup Payment
 * @apiParam {String} uid User ID.
 * @apiParam {Json} card Info
 * {
 *    "cards": [{
 *        "id": "5",
 *        "number": "6543287643898765432",
 *        "name": "Name On Card",
 *        "expiry": "03/21",
 *        "address": "Address of User",
 *    }]
 * }
 *
 * @apiSuccess {String} card Card Updated
 * @apiError NotUpdate Not Updated.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "Try Later"
 *     }
 * @apiSampleRequest /payment/card
 */


/**
 * @api {post} /notifications/register Register User
 * @apiName registernotifications
 * @apiGroup Push Notifications
 * @apiParam {String} id User ID.
 *
 * @apiSuccess {String} device Device has been added successfully.
 * @apiError NotFound Not Found.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "No cards found"
 *     }
 * @apiSampleRequest /notifications/register
 */


/**
 * @api {post} /notifications/userid/message Register User
 * @apiName registernotifications
 * @apiGroup Push Notifications
 * @apiParam {String} id User ID.
 * @apiParam {String} message Messages.
 *
 * @apiSuccess {String} status Message has been sent successfully.
 * @apiError NotFound Not Found.
 *
 * @apiErrorExample Error-Response:
 *     {
 *       "error": "No message delivered"
 *     }
 * @apiSampleRequest /notifications/userid/message
 */





