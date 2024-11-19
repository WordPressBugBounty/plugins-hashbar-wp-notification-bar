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

/***/ "./src/blocks/hashbar-promobanner/block.json":
/*!***************************************************!*\
  !*** ./src/blocks/hashbar-promobanner/block.json ***!
  \***************************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"hashbar/hashbar-promo-banner","title":"Hashbar Promo Banner","icon":"align-full-width","category":"hashbar-blocks","keywords":["hashbar","promo","banner"],"textdomain":"hashbar","editorScript":"file:./index.js","attributes":{"promoTitle":{"type":"string","default":"Add Promo Title"},"promoSummery":{"type":"string","default":"Add Promo Content"},"promobtnTxt":{"type":"string","default":"Button"},"openNewTab":{"type":"string","default":"no"},"promobtnLink":{"type":"string","default":"#"},"promobtnTxtColor":{"type":"string","default":"#1D1E22"},"promobtnBgColor":{"type":"string","default":"#fff"},"promoBgColor":{"type":"string","default":"#FB3555"},"promoTitleColor":{"type":"string","default":"#fff"},"promoContentColor":{"type":"string","default":"#fff"},"promoTitleFontSize":{"type":"string","default":"22px"},"promoContentFontSize":{"type":"string","default":"17px"},"bannerBorderRadius":{"type":"number","default":6},"promoBannerWidth":{"type":"number","default":250},"bannerBgImage":{"type":"object","default":{}},"imgOpacityValue":{"type":"number","default":0}}}');

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
/*!*************************************************!*\
  !*** ./src/blocks/hashbar-promobanner/index.js ***!
  \*************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/blocks/hashbar-promobanner/block.json");
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
    const handleLinkChange = link => {
      if (link.search('javascript:') >= 0) {
        setAttributes({
          promobtnLink: '#'
        });
      } else {
        setAttributes({
          promobtnLink: link
        });
      }
    };
    let promoButtonLinkFiltered = '';
    if (attributes.promobtnLink.search('javascript:') >= 0) {
      promoButtonLinkFiltered = '#';
      setAttributes({
        promobtnLink: '#'
      });
    } else {
      promoButtonLinkFiltered = attributes.promobtnLink;
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
    const styles = {
      selectedColorDisplay: {
        width: 30,
        height: 12,
        display: "inline-block",
        marginLeft: 10,
        verticalAlign: "middle"
      }
    };
    const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.useBlockProps)();
    blockProps.className = blockProps.className + ' ht-promo-banner';
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
      title: "Button Settings",
      className: "hashbar-block-panel"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Button Text", "hashbar"),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Insert Button Name", "hashbar"),
      value: attributes.promobtnTxt,
      onChange: btntxt => setAttributes({
        promobtnTxt: btntxt
      }),
      style: {
        marginBottom: 20
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Button Link", "hashbar"),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Insert Button Link", "hashbar"),
      value: attributes.promobtnLink,
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
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
      title: "Banner Style",
      initialOpen: false,
      className: "hashbar-block-panel"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item",
      style: {
        marginBottom: "20px",
        marginTop: "10px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Title Font Size", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FontSizePicker, {
      value: attributes.promoTitleFontSize,
      fontSizes: [{
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Small', 'awhitepixel'),
        slug: 'small',
        size: '22px'
      }, {
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Medium', 'awhitepixel'),
        slug: 'medium',
        size: '27px'
      }, {
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Large', 'awhitepixel'),
        slug: 'large',
        size: '32px'
      }],
      fallbackFontSize: attributes.promoTitleFontSize,
      onChange: val => setAttributes({
        promoTitleFontSize: val
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item",
      style: {
        marginBottom: "20px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Content Font Size", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FontSizePicker, {
      value: attributes.promoContentFontSize,
      fontSizes: [{
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Small', 'awhitepixel'),
        slug: 'small',
        size: '15px'
      }, {
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Medium', 'awhitepixel'),
        slug: 'medium',
        size: '17px'
      }, {
        name: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Large', 'awhitepixel'),
        slug: 'large',
        size: '20px'
      }],
      onChange: val => setAttributes({
        promoContentFontSize: val
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item",
      style: {
        marginBottom: "20px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      className: "option-title"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Background Image", "hashbar"))), attributes.bannerBgImage.img_ID ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "image-ctr",
      style: {
        marginBottom: 20
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("img", {
      src: attributes.bannerBgImage.img_url,
      alt: attributes.bannerBgImage.img_alt,
      style: {
        height: 'auto',
        width: 250
      }
    }), isSelected ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
      className: "btn-remove",
      onClick: () => removeImg()
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Dashicon, {
      icon: "no",
      size: "20"
    })) : null) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUploadCheck, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.MediaUpload, {
      allowedType: ['image'],
      value: undefined != attributes.bannerBgImage.img_ID ? attributes.bannerBgImage.img_ID : "",
      onSelect: selectImage,
      render: ({
        open
      }) => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.Button, {
        className: "button button-large",
        onClick: open
      }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Image', 'hashbar'))
    })), attributes.bannerBgImage.img_ID ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.RangeControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Background Image Opacity', 'hashbar'),
      value: attributes.imgOpacityValue,
      onChange: val => setAttributes({
        imgOpacityValue: val
      }),
      min: 0,
      max: 1,
      step: 0.1
    })) : null), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item banner-border-radius",
      style: {
        marginBottom: "10px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      className: "option-title"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Border Radius (px)", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.RangeControl, {
      value: attributes.bannerBorderRadius,
      onChange: val => setAttributes({
        bannerBorderRadius: parseInt(val)
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item ",
      style: {
        marginBottom: "10px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
      className: "option-title"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Width (px)", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.RangeControl, {
      value: attributes.promoBannerWidth,
      onChange: val => setAttributes({
        promoBannerWidth: parseInt(val)
      }),
      max: 500
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
      title: "Banner Color Settings",
      initialOpen: false,
      className: "hashbar-block-panel"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control",
      style: {
        marginBottom: "30px",
        marginTop: "10px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Title Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      colors: [{
        name: 'Black',
        color: '#000000'
      }, {
        name: 'Orange',
        color: '#FF6900'
      }, {
        name: 'Vivid Red',
        color: '#CF2E2E'
      }, {
        name: 'Pink',
        color: '#F78DA7'
      }, {
        name: 'White',
        color: '#FFFFFF'
      }, {
        name: 'Blue',
        color: '#8ED1FC'
      }],
      value: attributes.promoTitleColor,
      onChange: textcolor => setAttributes({
        promoTitleColor: textcolor
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control",
      style: {
        marginBottom: "30px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Content Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      colors: [{
        name: 'Black',
        color: '#000000'
      }, {
        name: 'Orange',
        color: '#FF6900'
      }, {
        name: 'Vivid Red',
        color: '#CF2E2E'
      }, {
        name: 'Pink',
        color: '#F78DA7'
      }, {
        name: 'White',
        color: '#FFFFFF'
      }, {
        name: 'Blue',
        color: '#8ED1FC'
      }],
      value: attributes.promoContentColor,
      onChange: textcolor => setAttributes({
        promoContentColor: textcolor
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control",
      style: {
        marginBottom: "30px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Background Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      colors: [{
        name: 'Black',
        color: '#000000'
      }, {
        name: 'Orange',
        color: '#FF6900'
      }, {
        name: 'Vivid Red',
        color: '#CF2E2E'
      }, {
        name: 'Pink',
        color: '#F78DA7'
      }, {
        name: 'White',
        color: '#FFFFFF'
      }, {
        name: 'Blue',
        color: '#8ED1FC'
      }],
      value: attributes.promoBgColor,
      onChange: bgcolor => setAttributes({
        promoBgColor: bgcolor
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control",
      style: {
        marginBottom: "30px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Button Text Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      colors: [{
        name: 'Black',
        color: '#000000'
      }, {
        name: 'Orange',
        color: '#FF6900'
      }, {
        name: 'Vivid Red',
        color: '#CF2E2E'
      }, {
        name: 'Pink',
        color: '#F78DA7'
      }, {
        name: 'White',
        color: '#FFFFFF'
      }, {
        name: 'Blue',
        color: '#8ED1FC'
      }],
      value: attributes.promobtnTxtColor,
      onChange: textcolor => setAttributes({
        promobtnTxtColor: textcolor
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control",
      style: {
        marginBottom: "30px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Button Background Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      colors: [{
        name: 'Black',
        color: '#000000'
      }, {
        name: 'Orange',
        color: '#FF6900'
      }, {
        name: 'Vivid Red',
        color: '#CF2E2E'
      }, {
        name: 'Pink',
        color: '#F78DA7'
      }, {
        name: 'White',
        color: '#FFFFFF'
      }, {
        name: 'Blue',
        color: '#8ED1FC'
      }],
      value: attributes.promobtnBgColor,
      onChange: textcolor => setAttributes({
        promobtnBgColor: textcolor
      })
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockProps,
      style: {
        width: attributes.promoBannerWidth + "px",
        backgroundColor: attributes.promoBgColor,
        backgroundImage: `url(${attributes.bannerBgImage.img_url})`,
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        borderRadius: attributes.bannerBorderRadius + "px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-content"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText, {
      className: "promo-title",
      value: attributes.promoTitle,
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Promo Title', "hashbar"),
      onChange: promotitle => setAttributes({
        promoTitle: promotitle
      }),
      style: {
        fontSize: `${attributes.promoTitleFontSize}`,
        color: `${attributes.promoTitleColor}`
      }
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText, {
      className: "promo-summery",
      value: attributes.promoSummery,
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Promo Content', "hashbar"),
      onChange: promosummery => setAttributes({
        promoSummery: promosummery
      }),
      style: {
        fontSize: `${attributes.promoContentFontSize}`,
        color: `${attributes.promoContentColor}`
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-promo-button"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: promoButtonLinkFiltered,
      style: {
        backgroundColor: attributes.promobtnBgColor,
        color: attributes.promobtnTxtColor
      }
    }, attributes.promobtnTxt)), attributes.bannerBgImage.img_ID ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-promo-overlay",
      style: {
        opacity: attributes.imgOpacityValue,
        borderRadius: attributes.bannerBorderRadius + "px"
      }
    }) : null));
  },
  save: ({
    attributes
  }) => {
    const blockPropsSave = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.useBlockProps.save({
      className: 'ht-promo-banner'
    });
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...blockPropsSave,
      style: {
        width: attributes.promoBannerWidth + "px",
        backgroundColor: attributes.promoBgColor,
        backgroundImage: `url(${attributes.bannerBgImage.img_url})`,
        backgroundPosition: 'center',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        borderRadius: attributes.bannerBorderRadius + "px"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-content"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText.Content, {
      className: "promo-title",
      tagName: "h4",
      value: attributes.promoTitle,
      style: {
        fontSize: `${attributes.promoTitleFontSize}`,
        color: `${attributes.promoTitleColor}`
      }
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText.Content, {
      className: "promo-summery",
      tagName: "p",
      value: attributes.promoSummery,
      style: {
        fontSize: `${attributes.promoContentFontSize}`,
        color: `${attributes.promoContentColor}`
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-promo-button"
    }, attributes.openNewTab === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: attributes.promobtnLink,
      target: "_blank",
      rel: "noopener noreferrer",
      style: {
        backgroundColor: attributes.promobtnBgColor,
        color: attributes.promobtnTxtColor
      }
    }, attributes.promobtnTxt) : (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      href: attributes.promobtnLink,
      style: {
        backgroundColor: attributes.promobtnBgColor,
        color: attributes.promobtnTxtColor
      }
    }, attributes.promobtnTxt)), attributes.bannerBgImage.img_ID ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "ht-promo-overlay",
      style: {
        opacity: attributes.imgOpacityValue,
        borderRadius: attributes.bannerBorderRadius + "px"
      }
    }) : null);
  }
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map