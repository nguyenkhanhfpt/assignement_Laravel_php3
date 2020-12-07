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
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin/news.js":
/*!************************************!*\
  !*** ./resources/js/admin/news.js ***!
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
  getListNews();
  viewNews();
  updateStatusMember();
  deleteNews();
}

function getListNews() {
  var url = '/admin/news';
  $('#table-news').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      type: 'GET',
      url: url
    },
    columns: [{
      data: 'image-news'
    }, {
      data: 'title'
    }, {
      data: 'description'
    }, {
      data: null,
      searchable: false,
      orderable: false,
      render: function render(data) {
        return "\n                        <button class=\"btn btn-info view-btn mb-1\" title=\"Chi ti\u1EBFt b\xE0i vi\u1EBFt\" data-id='".concat(data.id, "'>\n                            <i class=\"fal fa-eye\"></i>\n                        </button>\n                        <a href='news/").concat(data.id, "/edit' class=\"btn btn-warning mb-1\" title=\"Ch\u1EC9nh s\u1EEDa b\xE0i vi\u1EBFt\">\n                            <i class=\"fal fa-comment-alt-edit\"></i>\n                        </a>\n                        <button class=\"btn btn-danger reset-confirm-btn btn-delete-news\" data-id='").concat(data.id, "' title=\"X\xF3a b\xE0i vi\u1EBFt\">\n                            <i class=\"far fa-trash\"></i>\n                        </button>");
      }
    }],
    language: {
      "processing": "Đang tải..."
    },
    "displayLength": 25
  });
}

function deleteNews() {
  $('#table-news').on('click', '.btn-delete-news', function () {
    var id = $(this).data('id');
    Swal.fire({
      title: 'Bạn có chắc muốn xóa bài viết này!',
      icon: "question",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "X\xF3a"
    }).then(function (result) {
      if (result.value) {
        $.ajax({
          method: 'DELETE',
          url: "/admin/news/".concat(id),
          success: function success(res) {
            if (res.status == 200) {
              Swal.fire({
                title: res.message,
                icon: "success",
                confirmButtonText: "Tiếp tục"
              });
              $('#table-news').DataTable().ajax.reload();
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

function viewNews() {
  $('#table-news').on('click', '.view-btn', function () {
    var id = $(this).data('id');
    $.ajax({
      method: 'GET',
      url: "/admin/news/".concat(id),
      success: function success(res) {
        $('#view-news .modal-body').html(res);
        $('#view-news').modal();
      },
      error: function error(_error2) {
        Swal.fire({
          title: 'Đã có lỗi xảy ra!',
          icon: "error"
        });
      }
    });
  });
}

function updateStatusMember() {
  $(document).on('change', '.switch', function () {
    var id = $(this).data('id');
    var status = 0;

    if (this.checked) {
      status = 1;
    }

    $.ajax({
      method: 'PATCH',
      url: '/admin/members/' + id,
      data: {
        status: status
      },
      success: function success(res) {
        console.log(res);

        if (res.status == 200) {
          $('#table-news').DataTable().ajax.reload();
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
          title: 'Lỗi khi cập nhật trạng thái!',
          icon: "error"
        });
      }
    });
  });
}

/***/ }),

/***/ 15:
/*!******************************************!*\
  !*** multi ./resources/js/admin/news.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/user/Desktop/Dev/assignement_Laravel_php3/resources/js/admin/news.js */"./resources/js/admin/news.js");


/***/ })

/******/ });