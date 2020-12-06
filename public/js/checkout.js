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
/******/ 	return __webpack_require__(__webpack_require__.s = 6);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/checkout.js":
/*!**********************************!*\
  !*** ./resources/js/checkout.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#btn__buy').on('click', function (event) {
    event.preventDefault();
    var nameMember = $('#name_member').val();
    var phoneNumber = $('#phone_number').val();
    var address = $('#address').val();

    if (!nameMember || !phoneNumber || !address) {
      Swal.fire({
        title: 'Thông tin người mua hàng không được để trống',
        icon: "error",
        confirmButtonText: "Tiếp tục"
      });
      return;
    }

    $.ajax({
      method: 'POST',
      url: 'checkout',
      data: {
        name_member: nameMember,
        phone_number: phoneNumber,
        address: address
      },
      success: function success(res) {
        if (res.status == 200) {
          Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonText: "Tiếp tục"
          }).then(function (val) {
            window.location.href = '/cart';
          });
        } else {
          Swal.fire({
            title: res.message,
            icon: "error"
          });
        }
      },
      error: function error(err) {
        Swal.fire({
          title: 'Sảy ra lỗi khi thanh toán hàng, vui lòng thử lại sau!',
          icon: "error"
        });
      }
    });
  });
  $('.btn__apply').on('click', function () {
    var code = $('#code').val();

    if (!code) {
      Swal.fire({
        title: 'Bạn chưa nhập mã giảm giá!',
        icon: "error",
        confirmButtonText: "Tiếp tục"
      });
      return;
    }

    $.ajax({
      method: 'POST',
      url: 'checkout/checkCode',
      data: {
        code: code
      },
      success: function success(res) {
        if (res.status == 200) {
          $('#match_total_sale').text(res.totalCartSale);
          Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonText: "Tiếp tục"
          });
        } else {
          $('#match_total_sale').text(res.totalCartSale);
          $('#code').val('');
          Swal.fire({
            title: res.message,
            icon: "error"
          });
        }
      },
      error: function error(err) {
        Swal.fire({
          title: 'Sảy ra lỗi khi kiểm tra mã giảm giá!',
          icon: "error",
          confirmButtonText: "Tiếp tục"
        });
      }
    });
  });
});

/***/ }),

/***/ 6:
/*!****************************************!*\
  !*** multi ./resources/js/checkout.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/Desktop/Dev/assignement_Laravel_php3/resources/js/checkout.js */"./resources/js/checkout.js");


/***/ })

/******/ });