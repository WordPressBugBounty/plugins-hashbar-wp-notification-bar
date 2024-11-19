/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./src/blocks/promo-banner-img/block.json":
/*!************************************************!*\
  !*** ./src/blocks/promo-banner-img/block.json ***!
  \************************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"hashbar/hashbar-promo-banner-image","title":"Hashbar Promo Banner Image","icon":"format-image","category":"hashbar-blocks","keywords":["hashbar","promo","banner","Image"],"textdomain":"hashbar","editorScript":"file:./index.js","attributes":{"bannerBgImage":{"type":"object","default":{}},"imageLink":{"type":"string","default":"#"},"openNewTab":{"type":"string","default":"no"}}}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!**********************************************!*\
  !*** ./src/blocks/promo-banner-img/index.js ***!
  \**********************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/blocks/promo-banner-img/block.json");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__);







const hashbarGlobal = {
  pluginDirUrl: hashbarBlockParams.bannerImageURL
};
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_1__.name, {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(_block_json__WEBPACK_IMPORTED_MODULE_1__.title, "hashbar"),
  icon: _block_json__WEBPACK_IMPORTED_MODULE_1__.icon,
  category: _block_json__WEBPACK_IMPORTED_MODULE_1__.category,
  keywords: _block_json__WEBPACK_IMPORTED_MODULE_1__.keywords,
  example: {
    attributes: {
      value: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Hashbar Promo Banner', 'hashbar')
    }
  },
  attributes: _block_json__WEBPACK_IMPORTED_MODULE_1__.attributes,
  edit: ({
    attributes,
    setAttributes,
    className,
    isSelected
  }) => {
    const defaultImageUrl = hashbarGlobal.pluginDirUrl;
    const handleLinkChange = link => {
      if (link.search('javascript:') >= 0) {
        setAttributes({
          imageLink: '#'
        });
      } else {
        setAttributes({
          imageLink: link
        });
      }
    };
    let buttonLinkFilterd = '';
    if (attributes.imageLink.search('javascript:') >= 0) {
      buttonLinkFilterd = '#';
      setAttributes({
        imageLink: '#'
      });
    } else {
      buttonLinkFilterd = attributes.imageLink;
    }
    const setNewTab = () => {
      let newTabState = attributes.openNewTab;
      let setValue = newTabState === 'yes' ? 'no' : 'yes';
      setAttributes({
        openNewTab: setValue
      });
    };
    const selectImage = img => {
      const bannerBgImage = {
        ...attributes.bannerBgImage
      };
      bannerBgImage.img_ID = img.id;
      bannerBgImage.img_url = img.url;
      bannerBgImage.img_alt = img.alt;
      setAttributes({
        bannerBgImage
      });
    };
    const removeImg = () => {
      const bannerBgImage = {
        ...attributes.bannerBgImage
      };
      bannerBgImage.img_ID = null;
      bannerBgImage.img_url = null;
      bannerBgImage.img_alt = null;
      setAttributes({
        bannerBgImage
      });
    };
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
      title: "Imgage Settings"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Image Link", "hashbar"),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Enter Link", "hashbar"),
      value: attributes.imageLink,
      onChange: handleLinkChange,
      style: {
        marginBottom: 20
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item btn-appear-wrap",
      style: {
        marginBottom: 20
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      htmlFor: "open-new-tab"
    }, "Open Link In New Tab"), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FormToggle, {
      id: "open-new-tab",
      checked: attributes.openNewTab === 'yes',
      onChange: setNewTab
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...(0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.useBlockProps)()
    }, attributes.bannerBgImage.img_ID ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "image-ctr",
      style: {
        marginBottom: 20
      }
    }, attributes.openNewTab === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: buttonLinkFilterd,
      target: "_blank",
      rel: "noopener noreferrer"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: 'auto'
      }
    })) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: buttonLinkFilterd
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: '250px'
      }
    })), isSelected ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "image-button-wraper"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUploadCheck, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUpload, {
      allowedType: ['image'],
      value: undefined != attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_ID : "",
      onSelect: selectImage,
      render: ({
        open
      }) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
        className: "button-primary button-large",
        onClick: open,
        style: {
          marginBottom: 20
        }
      }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Image', ''))
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
      className: "button button-large banner-image-remove",
      onClick: () => removeImg()
    }, "Remove Image")) : null) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", null, attributes.openNewTab === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: buttonLinkFilterd,
      target: "_blank",
      rel: "noopener noreferrer"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: 'auto'
      }
    })) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: buttonLinkFilterd
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: '250px'
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "image-button-wraper"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUploadCheck, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUpload, {
      allowedType: ['image'],
      value: undefined != attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_ID : "",
      onSelect: selectImage,
      render: ({
        open
      }) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
        className: "button-primary button-large",
        onClick: open,
        style: {
          marginBottom: 20
        }
      }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Image', ''))
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
      className: "button button-large banner-image-remove",
      onClick: () => removeImg()
    }, "Remove Image")))));
  },
  save: ({
    attributes
  }) => {
    const defaultImageUrl = hashbarGlobal.pluginDirUrl;
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-promo-banner-image"
    }, attributes.openNewTab === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: attributes.imageLink,
      target: "_blank",
      rel: "noopener noreferrer"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: 'auto'
      }
    })) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: attributes.imageLink
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_url : defaultImageUrl,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: '250px'
      }
    })));
  },
  deprecated: [{
    attributes: {
      bannerBgImage: {
        type: "object",
        default: {}
      },
      imageLink: {
        type: "string",
        default: "#"
      },
      openNewTab: {
        type: "string",
        default: 'no'
      }
    },
    save(props) {
      const defaultImageUrl = hashbarGlobal.pluginDirUrl;
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: "ht-promo-banner-image"
      }, props.attributes.openNewTab === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
        href: props.attributes.imageLink,
        target: "_blank",
        rel: "noopener noreferrer"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
        src: props.attributes.bannerBgImage.img_ID ? props.attributes.bannerBgImage.img_url : defaultImageUrl,
        alt: props.attributes.bannerBgImage.img_alt,
        style: {
          height: 'auto',
          width: 'auto'
        }
      })) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
        href: props.attributes.imageLink
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
        src: props.attributes.bannerBgImage.img_ID ? props.attributes.bannerBgImage.img_url : defaultImageUrl,
        alt: props.attributes.bannerBgImage.img_alt,
        style: {
          height: 'auto',
          width: '250px'
        }
      })));
    }
  }]
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map