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

/***/ "./resources/js/admin/categories.js":
/*!******************************************!*\
  !*** ./resources/js/admin/categories.js ***!
  \******************************************/
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
  getListColor();
  addNewColor();
  deleteColor();
  editColor();
  updateColor();
}

function getListColor() {
  var url = '/admin/category';
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
      data: null,
      searchable: false,
      orderable: false,
      render: function render(data) {
        return "\n                        <button class=\"btn btn-info edit-btn\" title=\"Ch\u1EC9nh s\u1EEDa\" data-id='".concat(data.id, "'>\n                            <i class=\"fal fa-eye\"></i>\n                        </button>\n                        <button class=\"btn btn-danger reset-confirm-btn btn-delete-color\" data-id='").concat(data.id, "' title=\"X\xF3a\">\n                            <i class=\"far fa-trash\"></i>\n                        </button>");
      }
    }],
    language: {
      "processing": "Đang tải..."
    },
    "displayLength": 25
  });
}

function addNewColor() {
  $('#btn-add-color').on('click', function () {
    var name = $('#name').val();
    var url = '/admin/category/add';
    $.ajax({
      method: 'POST',
      url: url,
      data: {
        name: name
      },
      success: function success(res) {
        if (res.status == 200) {
          Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonText: "Tiếp tục"
          }).then(function (val) {
            $('#table-color').DataTable().ajax.reload();
            $('#addColors .close').click();
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
          title: 'Lỗi khi thêm mới!',
          icon: "error"
        });
      }
    });
  });
}

function deleteColor() {
  $('#table-color').on('click', '.btn-delete-color', function () {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Bạn có chắc muốn xóa danh mục!',
      icon: "question",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "X\xF3a"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          method: 'DELETE',
          url: "/admin/category/".concat(id),
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

function editColor() {
  $('#table-color').on('click', '.edit-btn', function () {
    var id = $(this).data('id');
    $.ajax({
      method: 'GET',
      url: '/admin/category/' + id + '/edit',
      success: function success(res) {
        if (res.id) {
          $('#name-edit').val(res.name);
          $('#id-edit').val(id);
          $('#editColors').modal('show');
        }
      },
      error: function error(_error2) {
        Swal.fire({
          title: 'Has some errors!',
          icon: "error"
        });
      }
    });
  });
}

function updateColor() {
  $('#btn-edit-color').on('click', function () {
    var name = $('#name-edit').val();
    var id = $('#id-edit').val();
    $.ajax({
      method: 'PATCH',
      url: '/admin/category/' + id,
      data: {
        name: name
      },
      success: function success(res) {
        if (res.status == 200) {
          $('#table-color').DataTable().ajax.reload();
          Swal.fire({
            title: res.message,
            icon: "success",
            confirmButtonText: "Tiếp tục"
          }).then(function (result) {
            $('#editColors .close').click();
            $('#form-edit-colors').trigger("reset");
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
          title: 'Lỗi khi cập nhật!',
          icon: "error"
        });
      }
    });
  });
}

/***/ }),

/***/ 11:
/*!************************************************!*\
  !*** multi ./resources/js/admin/categories.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/Desktop/Dev/assignement_Laravel_php3/resources/js/admin/categories.js */"./resources/js/admin/categories.js");


/***/ })

/******/ });