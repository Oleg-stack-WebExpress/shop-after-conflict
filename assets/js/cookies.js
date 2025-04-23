function setCookie(name, value, daysToLive) {
  var date = new Date();
  date.setTime(date.getTime() + (daysToLive * 24 * 60 * 60 * 1000));
  var expires = "expires=" + date.toUTCString();

  document.cookie = `${name}=${value}; ${expires}; path=/`;
}

function getCookie(name) {
  var cookieDecoded = decodeURIComponent(document.cookie);
  var cookieArray = cookieDecoded.split('; ');
  var result = null;

  cookieArray.forEach((cookie) => {
    if (cookie.indexOf(name) === 0) {
      result = cookie.substring(name.length + 1);
    }
  });

  return result;
}

function deleteCookie(name) {
  setCookie(name, null, null);
}