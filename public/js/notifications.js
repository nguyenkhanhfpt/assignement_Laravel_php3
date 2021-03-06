/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/notifications.js":
/*!***************************************!*\
  !*** ./resources/js/notifications.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function getAllNotifications() {
    $.ajax({
      method: 'GET',
      url: '/notifications',
      success: function success(res) {
        $('#notification-content').html(res.view);
        $('#number-notify').html(res.numUnRead);

        if (res.numUnRead) {
          $('.notify').addClass('d-block');
          $('.notify').removeClass('d-none');
        } else {
          $('.notify').removeClass('d-block');
          $('.notify').addClass('d-none');
        }
      },
      error: function error(err) {
        console.log(err);
      }
    });
  }

  function getNumBill() {
    $.ajax({
      method: 'GET',
      url: "/admin/update",
      success: function success(res) {
        $('#numPeddingBill').text(res.countBill);
      }
    });
  }

  $(document).on('click', '.message-center a', function () {
    var id = $(this).data('id');
    $.ajax({
      method: 'PATCH',
      url: "/notification/".concat(id),
      success: function success(res) {
        getAllNotifications();
      },
      error: function error(err) {
        console.log(err);
      }
    });
  });
  $(document).on('click', '.readed strong', function () {
    $.ajax({
      method: 'PATCH',
      url: "/notifications",
      success: function success(res) {
        getAllNotifications();
      },
      error: function error(err) {
        console.log(err);
      }
    });
  });
  var pusher = new Pusher('c3352eb7ef48eb784445', {
    cluster: 'ap1'
  });
  var channel = pusher.subscribe('notification-channel');
  channel.bind('notification-event', function (data) {
    getAllNotifications();
    getNumBill();
  });
  getAllNotifications();
});

/***/ }),

/***/ 5:
/*!*********************************************!*\
  !*** multi ./resources/js/notifications.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/Desktop/Dev/assignement_Laravel_php3/resources/js/notifications.js */"./resources/js/notifications.js");


/***/ })

/******/ });