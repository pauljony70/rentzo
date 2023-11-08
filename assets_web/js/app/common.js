(function () {
    function checkDeviceType() {
      var userAgent = navigator.userAgent.toLowerCase();
  
      if (userAgent.match(/mobile|android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i)) {
        // Mobile device
        document.body.classList.add('responsive-body');
      } else if (userAgent.match(/tablet|ipad/i)) {
        // Tablet device
        document.body.classList.add('responsive-body');
      } else {
        // Desktop device
        document.body.classList.remove('responsive-body');
      }
    }
  
    window.addEventListener('load', checkDeviceType);
    window.addEventListener('resize', checkDeviceType);
  })();