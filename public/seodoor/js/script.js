function init() {
  // 取得GPS
  if ("geolocation" in navigator) {
    /* geolocation is available */
    // alert("geolocation is available");
    navigator.geolocation.getCurrentPosition(function (position) {
      document.querySelector('form input[name=lon]').value=position.coords.longitude;
      document.querySelector('form input[name=lat]').value=position.coords.latitude;
    });
  }


  document.querySelector("#gogo").addEventListener('click', function () {
    console.log('gogo');
    document.querySelector('form input[name=action]').value="前往";
    document.querySelector('form button').click()

  });
  document.querySelector("#close").addEventListener('click', function () {
    console.log('close');
    document.querySelector('form input[name=action]').value="離開";
    document.querySelector('form button').click()
  });


  // 校正ios100vh的問題
  const detectBrowser = {
    isIOs: () => /iPad|iPhone|iPod/.test(navigator.userAgent),
  }
  if (detectBrowser.isIOs()) {
    function safariHacks(dom_class_name) {
      let windowsVH = window.innerHeight / 100;
      document.querySelector(`.${dom_class_name}`).style.setProperty('--vh', windowsVH + 'px');
      window.addEventListener('resize', function () {
        document.querySelector(`.${dom_class_name}`).style.setProperty('--vh', windowsVH + 'px');
      });
    }
    safariHacks('wrap');
    safariHacks('modal');
  }


}

init()





