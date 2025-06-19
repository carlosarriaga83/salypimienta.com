<?php $script ='<script>
    // ======================== Upload Image Start =====================
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = new Image();
            img.onload = function() {
                var canvas = document.createElement("canvas");
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0);

                var MAX_WIDTH = 800;
                var MAX_HEIGHT = 600;
                var width = img.width;
                var height = img.height;

                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width;
                        width = MAX_WIDTH;
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height;
                        height = MAX_HEIGHT;
                    }
                }
                canvas.width = width;
                canvas.height = height;
                var ctx = canvas.getContext("2d");
                ctx.drawImage(img, 0, 0, width, height);

                var dataurl = canvas.toDataURL("image/png");

                $("#imagePreview").css("background-image", "url(" + dataurl + ")");
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(650);
                $("#DISH_PIC").prop("src",dataurl);
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
    $("#imageUpload").change(function() {
        readURL(this);
    });
    // ======================== Upload Image End =====================

    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on("click", function() {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle(".toggle-password");
    // ========================= Password Show Hide Js End ===========================
    </script>';?>
    

<?php include './partials/layouts/layoutTop.php' ?>
<?php 	
    //error_reporting(E_ALL);
	//ini_set('display_errors', 1);
    
    
    //session_start(); 
    
    include_once './PHP/MYF1.php';
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        //echo "Name: " . htmlspecialchars($name); // Use htmlspecialchars to prevent XSS
    }else{
        //$id = $_SESSION['USER']['ID'];
    }
    
	$q = sprintf("SELECT * FROM Dishes WHERE id = '%s'   ", $id );  // echo $q . "\n";
	$R1 = SQL_2_OBJ_V2($q);
	//print_r($R1);die;
	
	$DISH 	= $R1['PL'][0];
    
    
?>



        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">View Profile</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">View Profile</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
                        <img src="assets/images/user-grid/user-grid-bg1.png" alt="" class="w-100 object-fit-cover">
                        <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                            <div class="text-center border border-top-0 border-start-0 border-end-0">
                                <img src="<?php echo $DISH['DISH_PIC']; ?>" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                                <h6 class="mb-0 mt-16"><?php echo $DISH['NAME']; ?></h6>
                                
                            </div>
                            <div class="mt-24">
                                <h6 class="text-xl mb-16">Dish Info</h6>
                                <ul>
                                    <li class="d-flex align-items-center gap-1 mb-12">
                                        <span class="w-30 text-md fw-semibold text-primary-light">Name</span>
                                        <span class="w-70 text-secondary-light fw-medium">: <?php echo $DISH['NAME']; ?></span>
                                    </li>

                                    <li class="d-flex align-items-center gap-1">
                                        <span class="w-30 text-md fw-semibold text-primary-light"> Descripcion</span>
                                        <span class="w-70 text-secondary-light fw-medium">: <?php echo $DISH['DESCRIPCION']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card h-100">
                        <div class="card-body p-24">
                            <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab" aria-controls="pills-edit-profile" aria-selected="true">
                                        Edit Profile
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24" id="pills-change-passwork-tab" data-bs-toggle="pill" data-bs-target="#pills-change-passwork" type="button" role="tab" aria-controls="pills-change-passwork" aria-selected="false" tabindex="-1">
                                        Change Password
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link d-flex align-items-center px-24" id="pills-notification-tab" data-bs-toggle="pill" data-bs-target="#pills-notification" type="button" role="tab" aria-controls="pills-notification" aria-selected="false" tabindex="-1">
                                        Notification Settings
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel" aria-labelledby="pills-edit-profile-tab" tabindex="0">
                                    <h6 class="text-md text-primary-light mb-16">Dish Image</h6>
                                    <!-- Upload Image Start -->
                                    <div class="mb-24 mt-16">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                                <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden>
                                                <label for="imageUpload" class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                                    <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                                </label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Upload Image End -->
                                    <form id="FRM_USER_PROFILE" action="#" FRM="FRM_USER_PROFILE" DB="Dishes">
										<input type="text" name="EDIT_ID" value="<?php echo $DISH['ID']; ?>" readonly>
										<img id="DISH_PIC" name="DISH_PIC" src="<?php echo $DISH['DISH_PIC']; ?>" class="mb-24 mt-16" hidden></img>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-20">
                                                    <label for="name" class="form-label fw-semibold text-primary-light text-sm mb-8">Name <span class="text-danger-600">*</span></label>
                                                    <input type="text" class="form-control radius-8" id="name" placeholder="Enter Dish Name"  name="NAME"  value="<?php echo $DISH['NAME']; ?>" required='required'>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="mb-20">
                                                    <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                                                    <textarea class="form-control radius-8" id="desc" placeholder="Write description..." name="DESCRIPCION" ><?php echo $DISH['DESCRIPCION']; ?></textarea>
                                                </div>
                                            </div>


                                            <div class="col-sm-6">
                                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                                    <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Vegetariano</span>

                                                        <?php $DISH['OPT_VEGETARIANO'] == 'on' ? $CHECKED = 'checked' : $CHECKED = ''; ?>

                                                        <input class="form-check-input" type="checkbox" role="switch" id="companzNew" name="OPT_VEGETARIANO" <?php echo $CHECKED; ?> >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                                    <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                                    <div class="d-flex align-items-center gap-3 justify-content-between">
                                                        <span class="form-check-label line-height-1 fw-medium text-secondary-light">Vegano</span>

                                                        <?php $DISH['OPT_VEGANO'] == 'on' ? $CHECKED = 'checked' : $CHECKED = ''; ?>

                                                        <input class="form-check-input" type="checkbox" role="switch" id="companzNew" name="OPT_VEGANO" <?php echo $CHECKED; ?> >
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center gap-3 mt-48">
                                            <a href="./Ver_platillos.php">
                                                <button type="button"  class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-56 py-11 radius-8">
                                                    Regresar
                                                </button>
                                            </a>
                                            <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8" onclick="" >
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-change-passwork" role="tabpanel" aria-labelledby="pills-change-passwork-tab" tabindex="0">
                                    <form id="FRM_USER_PROFILE_PWD" action="#" FRM="FRM_USER_PROFILE_PWD" DB="Users">
                                    <input type="text" name="EDIT_ID" value="<?php echo $DISH['ID']; ?>">
                                   
                                        <div class="mb-20">
                                            <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*" name="PWD" required>
                                                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span>
                                            </div>
                                        </div>
                                        <div class="mb-20">
                                            <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
                                            <div class="position-relative">
                                                <input type="password" class="form-control radius-8" id="confirm-password" placeholder="Confirm Password*" name="PWD2" required>
                                                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex align-items-center justify-content-center gap-3">

                                            <button type="submit" class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8" onclick="" >
                                                Save
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab" tabindex="0">
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="companzNew" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Company News</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="companzNew">
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="pushNotifcation" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Push Notification</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="pushNotifcation" checked>
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="weeklyLetters" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Weekly News Letters</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="weeklyLetters" checked>
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="meetUp" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Meetups Near you</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="meetUp">
                                        </div>
                                    </div>
                                    <div class="form-switch switch-primary py-12 px-16 border radius-8 position-relative mb-16">
                                        <label for="orderNotification" class="position-absolute w-100 h-100 start-0 top-0"></label>
                                        <div class="d-flex align-items-center gap-3 justify-content-between">
                                            <span class="form-check-label line-height-1 fw-medium text-secondary-light">Orders Notifications</span>
                                            <input class="form-check-input" type="checkbox" role="switch" id="orderNotification" checked>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php include './partials/layouts/layoutBottom.php' ?>

<script>	
	$(document).ready(function() {
    
        hideAlertAfterTime($('.alert'), 5000);
		
		$("#imagePreview").css("background-image", "url( <?php echo $DISH['DISH_PIC']; ?> )");
        
        $(document).on('submit','#FRM_USER_PROFILE', function VALIDAR(e) { 
        //$('#formulario').on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
          
            
            // everything looks good!
            e.preventDefault(); //prevent submit
            SAVE_CHANGES(this);
            
          }
        });
        
        $(document).on('submit','#FRM_USER_PROFILE_PWD', function VALIDAR(e) { 
        //$('#formulario').on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            e.preventDefault(); //prevent submit
            var PWD = $('input[name="PWD"]').val();
            var PWD2 = $('input[name="PWD2"]').val();
            //$('input[name="PWD"]').val(PWD1);
            
            debugger;
            if ( PWD == PWD2){
                SAVE_CHANGES(this);
            }
          }
        });
        
            
    });


	
</script>

<script>



    // Usage example:
$('input[name="EMAIL"]').on('blur keyup', function() {
        debugger;

        OBJ = {};
        
        
        OBJ['TABLA']         = 'Users';
        OBJ['SEARCH_FOR']    = $(this).val();

        debugger;
        var resp = POST_API(OBJ, 'API/does_exist/', true);
        debugger;

        if (resp.DATOS == 0){ 
            var VALIDATED_DIV = $('input[name="EMAIL"]').closest( "div" );
            //VALIDATED_DIV.addClass('was-validated'); //.css( "background-color", "green" );
            $('input[name="EMAIL"]').addClass( 'bg-success-focus' ).removeClass( 'bg-danger-focus' );
            //debugger;

        }else{
            var VALIDATED_DIV = $('input[name="EMAIL"]').closest( "div" );
            //VALIDATED_DIV.removeClass('was-validated'); //
            $('input[name="EMAIL"]').addClass( 'bg-danger-focus' ).removeClass( 'bg-success-focus' );
            //debugger;

        }

        if ( $('input[name="EMAIL"]').val() == '' ) { $('input[name="EMAIL"]').removeClass( 'bg-success-focus' ).removeClass( 'bg-danger-focus' ); }


    });


</script>