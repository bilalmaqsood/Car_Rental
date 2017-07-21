<template>
    <div id="car_inspection" class="tab-pane fade active in">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#car_front">Front</a></li>
            <li><a data-toggle="tab" href="#car_rear">Rear</a></li>
            <li><a data-toggle="tab" href="#car_driver_side">Driver side</a></li>
            <li><a data-toggle="tab" href="#car_off_side">Off side</a></li>
            <li><a data-toggle="tab" href="#car_notes">Notes</a></li>
        </ul>

        <div class="tab-content">

            <div id="car_front" class="tab-pane fade in active">
                <div class="dummy_car carcondition-img" id="pageSidefront">
                    <img src="images/front.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
                        <input type="text" palceholder="add description" v-model="description">
                        <span>
									<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
                        </span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
                        </span>
                        <span>
									<svg @click="drawSpots('front')" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class=" clickable svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
                        </span>
                    </div>

                </div>
            </div>

            <div id="car_rear" class="tab-pane fade">
                <div class="dummy_car">
                    <img src="images/rear.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
                        <input type="text" palceholder="add description" v-model="description">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
                    </div>

                </div>
            </div>
            <div id="car_driver_side" class="tab-pane fade">
                <div class="dummy_car">
                    <img src="images/driver_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
                        <input type="text" palceholder="add description" v-model="description">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
                    </div>

                </div>
            </div>
            <div id="car_off_side" class="tab-pane fade">
                <div class="dummy_car">
                    <img src="images/off_side.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
                        <input type="text" palceholder="add description" v-model="description">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
                    </div>

                </div>
            </div>
            <div id="car_notes" class="tab-pane fade">
                <div class="dummy_car">
                    <img src="images/dummy_car.png" alt="">
                </div>
                <div class="front_back_size">
                    <div class="add_description_icon">
                        <input type="text" palceholder="add description" v-model="description">
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#hellp"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 21" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#photo_camera"></use>
									</svg>
								</span>
                        <span>
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20" class="svg-icon">
										<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#paint_icon"></use>
									</svg>
								</span>
                    </div>

                </div>
            </div>
            <div class="hidden spots_area">
                <p>Scratch 1.2 inches - front door</p>
                <p>Bump 0.2 inches rear bumper</p>
                <img src="images/front.png" alt="" />
            </div>
        </div>

    </div>
</template>

<script>

    var $scope;
    var GtotalWidth, GtotalHeight;
    var sportNum = 1;

    export default {

        data() {
            return {
                description: '',
                inspection: {
                type: '',
                data: [],
                }
            };
        },

        mounted() {
            $scope=this;



        },

        methods: {
            drawSpots(currentPage){

                GtotalWidth = parseInt($('.carcondition-img').width());
                GtotalHeight = parseInt($('.carcondition-img').height());


                $('#pageSide' + currentPage).prepend('<div id="mydraggable" data-drag-id="' + sportNum +'" style="top:50%; left:50%; z-index: 99;" class="mydraggable draggable' + sportNum + '"><div id="mydragcontrols"><span id="myfix" data-drag-id="' + sportNum + '" style="color: green"><i class="fa fa-check" aria-hidden="true"></i></span><span id="mydeldrag" style="color: red"><i class="fa fa-times" aria-hidden="true"></i></span></div></div>');
                $('.mydraggable').show();
                sportNum++;
                $('.mydraggable').draggable({
                    containment: 'parent',
                    stop: function () {
                        var l = ( 100 * parseFloat($(this).position().left / parseFloat($(this).parent().width())) ) + "%" ;
                        var t = ( 100 * parseFloat($(this).position().top / parseFloat($(this).parent().height())) ) + "%" ;
                        $(this).css("left", l);
                        $(this).css("top", t);
                    }
                });
            },
            prepareComponent(){
                $.fn.visibleHeight = function() {
                    var elBottom, elTop, scrollBot, scrollTop, visibleBottom, visibleTop;
                    scrollTop = $(window).scrollTop();
                    scrollBot = scrollTop + $(window).height();
                    elTop = this.offset().top;
                    elBottom = elTop + this.outerHeight();
                    visibleTop = elTop < scrollTop ? scrollTop : elTop;
                    visibleBottom = elBottom > scrollBot ? scrollBot : elBottom;
                    return visibleBottom - visibleTop;
                };

                $(document).on('click', '#myfix', function() {
                    //var currentPage = jQuery('#pageNumber').val();
                    var currentPage = $(this).parents('.carcondition-img').data('page-number');
                    console.log(currentPage);

                    var spotNum = $(this).data('drag-id');
                    alert(spotNum);


                    var topCoord = $('.draggable'+spotNum)[0].style.top;
                    var leftCoord = $('.draggable'+spotNum)[0].style.left;
                    var ZIndexCoord = $(this).parents('.mydraggable').css("z-index");

                    window.parent.takemysign(topCoord, leftCoord, currentPage, spotNum, ZIndexCoord);

                });

                $(document).on('click', '#mydeldrag', function() {

                    var carID = $('meta[name="carID"]').attr('content');
                    var spot_id = $(this).parents('.mydraggable').data('spot-id');
                    var spot_page_id = $(this).parents('.mydraggable').data('spot-page-id');

                    if (spot_id === undefined){
                        $(this).parents('.mydraggable').remove();
                    }else {
                        $.ajax({
                            url: "{{ url('/admin/ajax/cars/del-vehicle-spot') }}",
                            type: 'post',
                            data: $.param({'_token' : '{{ csrf_token() }}','spot_id': spot_id, 'spot_page_id': spot_page_id, 'car_id' : carID}),
                            success: function(response) {
                                if (response.success === true){
                                    $(this).parents('.mydraggable').remove();
                                    $('.spot_'+response.data.id+'_'+response.data.side_num).remove();
                                    $('.des_'+response.data.id+'_'+response.data.side_num).remove();
                                }
                            }
                        });
                    }

                });
            }
        }
    }
</script>
