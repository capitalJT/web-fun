<?php
/////////////////////////////////////////////////////////////////////
// This is the only portion of the code you may need to change.
// Indicate the location of your images
$root = '';
// use if specifying path from root
// $root = $_SERVER['DOCUMENT_ROOT'];

// This is a temp hack
$path = '../../public/images/Facebox/Images-Circle-640px/';

// End of user modified section
/////////////////////////////////////////////////////////////////////

function getImagesFromDir($path)
{
    $images = array();
    if ($img_dir = @opendir($path)) {
        while (false !== ($img_file = readdir($img_dir))) {
            // checks for gif, jpg, png
            if (preg_match("/(\.gif|\.jpg|\.png)$/", $img_file)) {
                $images[] = $img_file;
            }
        }
        closedir($img_dir);
    }
    return $images;
}

function getRandomFromArray($ar)
{
    mt_srand((double)microtime() * 1000000); // php 4.2+ not needed
    $num = array_rand($ar);
    return $ar[$num];
}

// Obtain list of images from directory
//    $imgList = getImagesFromDir($root . $path);
$imgList = getImagesFromDir($path);

$img = getRandomFromArray($imgList);
?>
<!-- #pop-up is the "lightbox overlay" -->
<div id="pop-up">
    <!-- #img-container is the container for the pop up ad -->
    <span id="img-container">
        <span id="close-btn">X</span>
        <a href="//jabaltorres.com/demos/web-fun" target="_blank"><img src="<?php echo $path . $img ?>" alt=""></a>
    </span>
</div>

<script>

	var fiveTwoFivePopUp = fiveTwoFivePopUp || {
		// Init function sets the stage.
		// Should probably declare all global variables here.
		init: function () {
			// get the pop up conatainer
			var popUpContainer = document.getElementById('pop-up');

			// get the close btn
			var closeBtn = document.getElementById("close-btn");

			// declare hide pop up function
			function hidePopUp() {
				popUpContainer.style.display = "none";
			}

			// add click event to close button
			closeBtn.addEventListener("click", function () {
				hidePopUp();
			});

			// add click event to container
			popUpContainer.addEventListener("click", function () {
				hidePopUp();
			});

			// setting up the show pop up
			function showPopUP() {
				popUpContainer.style.display = "initial";
			}

			// setting up the delay function
			function delayedPopUp() {
				setTimeout(showPopUP, 3000);
			}

			function setCookie(cname, cvalue, exdays) {
				var d = new Date();
				// d.setTime(d.getTime() + (exdays*24*60*60*1000)); // cookie expires in 24 hours
				d.setTime(d.getTime() + (exdays * 60 * 1000)); // cookie expires in 10 seconds
				var expires = "expires=" + d.toGMTString();
				document.cookie = cname + "=" + cvalue + "; " + expires;
			}

			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for (var i = 0; i < ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0) == ' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					}
				}
				// This return statement clears the value of the key
				return "";
			}

			function checkCookie() {
				let kookieName = "returnvisitor";

				// console.log("kookieName: ", kookieName);

				var key = getCookie(kookieName);
				// if key isn't empty
				if (key != "") {
					// action if user returns within set time
					hidePopUp();
					console.log("Welcome back user");
				} else {
					// action if this is the first visit
					// user = prompt("Please enter your name:","");

					key = "yes";
					if (key != "" && key != null) {
						setCookie(kookieName, key, 1);
						//    console.log("set cookie name to: ", kookieName);
					}

					// delayedPopUp(); // Uncomment production - comment development
					showPopUP(); // Uncomment development - comment production

					console.log("This is your first time here");
				}
			}

			// These are the functions that get called within the Init
			checkCookie();

			// Calling a function outside of the Init
			fiveTwoFivePopUp.popUpConsole();
		},
		popUpConsole: function () {
			const allCookies = document.cookie;
			console.log("popUpConsole function has fired. Here are all of the cookies: " + allCookies)

			// console log all cookies into a console table
			console.table(allCookies);

		}
	};

	document.addEventListener("DOMContentLoaded", function (event) {
		//do work
		fiveTwoFivePopUp.init();
		fiveTwoFivePopUp.popUpConsole();
	});
</script>