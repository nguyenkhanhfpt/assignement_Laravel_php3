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
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/code.js":
/*!************************************!*\
  !*** ./resources/js/admin/code.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  listen();
});

function listen() {
  getListCode();
  addNewCode();
  deleteCode();
}

function getListCode() {
  var url = '/admin/codes';
  $('#table-color').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      type: 'GET',
      url: url
    },
    columns: [{
      data: 'id'
    }, {
      data: 'name'
    }, {
      data: 'sale'
    }, {
      data: 'start'
    }, {
      data: 'end'
    }, {
      data: 'status'
    }, {
      data: null,
      searchable: false,
      orderable: false,
      render: function render(data) {
        return "\n                        <button class=\"btn btn-danger reset-confirm-btn btn-delete-code\" data-id='".concat(data.id, "' title=\"X\xF3a\">\n                            <i class=\"far fa-trash\"></i>\n                        </button>");
      }
    }],
    language: {
      "processing": "Đang tải..."
    },
    "displayLength": 25
  });
}

function addNewCode() {
  $('#btn-add-code').on('click', function () {
    var name = $('#name').val();
    var price = $('#price').val();
    var start = $('#start').val();
    var end = $('#end').val();
    var url = '/admin/codes';

    if (new Date(start).getTime() > new Date(end).getTime()) {
      Swal.fire({
        title: 'Ngày bắt đầu không được sau ngày kết thúc!',
        icon: "error"
      });
      return;
    }

    $.ajax({
      method: 'POST',
      url: url,
      data: {
        name: name,
        price: price,
        start: start,
        end: end
      },
      success: function success(res) {
        if (res.status == 200) {
          Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonText: "Tiếp tục"
          }).then(function (val) {
            $('#table-color').DataTable().ajax.reload();
            $('#addCodes .close').click();
            $('#form-colors').trigger("reset");
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
          title: 'Lỗi khi thêm mới mã giảm giá!',
          icon: "error"
        });
      }
    });
  });
}

function deleteCode() {
  $('#table-color').on('click', '.btn-delete-code', function () {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Bạn có chắc muốn xóa mã giảm giá!',
      icon: "question",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "X\xF3a"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          method: 'DELETE',
          url: "/admin/codes/".concat(id),
          success: function success(res) {
            if (res.status == 200) {
              Swal.fire({
                title: res.message,
                icon: "success",
                confirmButtonText: "Tiếp tục"
              });
              $('#table-color').DataTable().ajax.reload();
            } else {
              Swal.fire({
                title: res.message,
                icon: "error"
              });
            }
          },
          error: function error(_error) {
            Swal.fire({
              title: 'Lỗi khi xóa!',
              icon: "error"
            });
          }
        });
      }
    });
  });
}

/***/ }),

/***/ 11:
/*!******************************************!*\
  !*** multi ./resources/js/admin/code.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/Desktop/Dev/assignement_Laravel_php3/resources/js/admin/code.js */"./resources/js/admin/code.js");


/***/ })

/******/ });