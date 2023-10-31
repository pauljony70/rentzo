		
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<!--  Include jQuery core into head section if not already exists -->
<!--<script src="https://www.fleekmart.com/assets/jquery.min.js"></script>-->

<!--  AJAX-ZOOM JavaScript -->
<script type="text/javascript" src="https://www.fleekmart.com/assets/jquery.axZm.js"></script>
<link type="text/css" href="https://www.fleekmart.com/assets/axZm.css" rel="stylesheet" />

<!-- JavaScript for 360/3D gallery -->
<script type="text/javascript" src="https://www.fleekmart.com/assets/jquery.axZm.360Gallery.js"></script>
<link rel="stylesheet" type="text/css" href="https://www.fleekmart.com/assets/jquery.axZm.360Gallery.css" />

<!-- Include axZm.thumbSlider -->
<link rel="stylesheet" type="text/css" href="https://www.fleekmart.com/assets/jquery.axZm.thumbSlider.css" />
<script type="text/javascript" src="https://www.fleekmart.com/assets/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="https://www.fleekmart.com/assets/jquery.axZm.thumbSlider.js"></script>

<!--<script type="text/javascript" src="https://www.fleekmart.com/assets/prism.css"></script>
<script type="text/javascript" src="https://www.fleekmart.com/assets/prism.min.js"></script>-->

<style>
#playerWrap {
	padding-right: 120px; /* width of the gallery */
	height: 600px;
	max-height: calc(100vh - 50px);
	position: relative;
}

#spinGalleryContainer {
	position: absolute;
	z-index: 11;
	width: 120px;
	height: 100%;
	right: 0px;
	top: 0px;
}

#axZmPlayerContainer {
	position: relative;
	height: 100%;
}

#spinGallery {
	position: absolute;
	right: 0;
	width: 110px;
	height: 100%;
	overflow: hidden;
}

/* hide gallery for small screens */
@media (max-width: 768px) {
	#spinGalleryContainer {
		display: none;
	}
	#playerWrap {
		padding-right: 0;
		height: 400px;
	}
}
</style>

</head>
<body>
<div id="playerWrap">
	<!-- Container where AJAX-ZOOM will be loaded into -->
	<div id="axZmPlayerContainer">
		<h4>Loading, please wait...</h4>
	</div>

	<div id="spinGalleryContainer">
		<!-- Thumb slider -->
		<div id="spinGallery">
			<!-- Temp message that will be removed after the slider initialization -->
			<div id="spinGallery_temp" class="spinGallery_temp">
				Gallery will be loaded...
			</div>
		</div>
	</div>
</div>
</body>
<script>
// Load 360 gallery and first spin
jQuery.axZm360Gallery ({
	//axZmPath: "../axZm/", // Path to /axZm/ directory, e.g. "/test/axZm/"

	// Over galleryData" option you can precisely define which 360s or 3D have to beloaded.
	// Additionally you can also define regular 2D images and videos located at
	// some straming platform like youtube, iframed content or load content over ajax
	galleryData: [
		["imageZoom", "https://www.fleekmart.com/assets/3602.jpg"],
		["imageZoom", "https://www.fleekmart.com/assets/360.jpeg"]
	],

	// AJAX-ZOOM supports "hotspots" which can be optionally loaded
	// for 3D/360 or 2D (plain images).
	// Hotspots can be configured manually in example33.php
	// galleryHotspots: {
		// bike360: "../pic/hotspotJS/bike.js"
	// },

	axZmCallBacks: {
	onLoad: function(){
		console.log('onLoad fired');
	},
	onSpinPreloadEnd: function(){
		console.log('spin preloaded');
	}
},

	firstToLoad: "imageZoom", // name of 360, "imageZoom" or null

	// Some of the AJAX-ZOOM option normally set in zoomConfig.inc.php and zoomConfigCustom.inc.php
	// can be set directly as js var in this callback
	azOptions: {
		//e.g.
		// zoomSlider: false,
		// gallerySlideNavi: true,
		// gallerySlideNaviOnlyFullScreen: true
	},

	//divID: "axZmPlayerContainer", // The ID of the element (placeholder) where AJAX-ZOOM has to be inserted into
	//embedResponsive: true, // if divID is responsive, set this to true
	//spinGalleryContainerID: "spinGalleryContainer", // Parent container of gallery div
	//spinGalleryID: "spinGallery",
	//spinGallery_tempID: "spinGallery_temp",

	// background color of the player, possible values: #hex color or "auto"
	// if "auto" AJAX-ZOOM will try to determin the background color
	// use "auto" only if you have e.g. black and white on different 360s
	backgroundColor: "#FFFFFF",

	// Set to check spinReverse / spinReverseZ settings upon the below options (toReverseArr, toReverseArrZ)
	checkReverse: true,

	// Array with folder names where spinReverse option should be applied
	toReverseArr: [
		"Uvex_Occhiali",
		"Atomic",
		"Floete",
		"Nike_Running",
		"Pelican",
		"Speed_Strength_BlackJacket",
		"Speed_Strength_WhiteJacket",
		"Uzi_32"
	],

	// Array with folder names where spinReverseZ option should be applied
	toReverseArrZ: [],
	toBounceArr: ["Teva"],

	// use axZmThumbSlider extension for the thumbs, set false to disable
	axZmThumbSlider: true,

	// Options passed to $.axZmThumbSlider
	// For more information see /axZm/extensions/axZmThumbSlider/
	axZmThumbSliderParam: {
		btn: false,
		orientation: "vertical",
		scrollbar: true,
		scrollbarMargin: 10,
		wrapStyle: {borderWidth: 0}
		//scrollbarClass: "axZmThumbSlider_scrollbar_thin"
	},
 
	// try to open AJAX-ZOOM at browsers fullscreen mode
	fullScreenApi: false,

	// Show 360 thumb gallery at fullscreen mode,
	// possible values: "bottom", "top", "left", "right" or false
	thumbsAtFullscreen: false,

	thumbsCache: true, // cache thumbnails
	thumbWidth: 87, // width of the thumbnail image
	thumbHeight: 87, // height of the thumbnail image
	thumbQual: 90, // jpg quality of the thumbnail image
	thumbMode: false, // possible values: "contain", "cover" or false
	thumbBackColor: "#FFFFFF", // background color of the thumb if thumbMode is set to "contain"
	thumbRetina: true, // true will double the resolution of the thumbnails
	thumbDescr: true, // Show thumb description

	// Custom description of the thumbs
	thumbDescrObj: {
		"3602.jpg": "Image 1",
		"360.jpeg": "Image 2",
	},
	thumbIcon: true // Show 360 or 3D icon for the thumbs
});
</script>
</html>
