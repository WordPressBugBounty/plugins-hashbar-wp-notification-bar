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

/***/ "./src/blocks/hashbar-notification/block.json":
/*!****************************************************!*\
  !*** ./src/blocks/hashbar-notification/block.json ***!
  \****************************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"hashbar/hashbar-button","title":"Hashbar Notification","icon":"info","category":"hashbar-blocks","keywords":["hashbar","button","notification"],"textdomain":"hashbar","editorScript":"file:./index.js","attributes":{"textAlignment":{"type":"string"},"hasbarButton":{"type":"object","default":{"text":"Button","link":"#"}},"hasbarBtnFontSize":{"type":"number","default":18},"hashbarBtnRemove":{"type":"string","default":"yes"},"hashbarBtnNofollow":{"type":"string","default":"no"},"hashbarBtnSponsor":{"type":"string","default":"no"},"hashbarBtnNewTab":{"type":"string","default":"no"},"hashbarContent":{"type":"string"},"BtnBorderRadius":{"type":"number","default":3},"BtnMarginTop":{"type":"number","default":0},"BtnMarginRight":{"type":"number","default":20},"BtnMarginBottom":{"type":"number","default":0},"BtnMarginLeft":{"type":"number","default":20},"BtnPaddingTop":{"type":"number","default":10},"BtnPaddingRight":{"type":"number","default":30},"BtnPaddingBottom":{"type":"number","default":10},"BtnPaddingLeft":{"type":"number","default":30},"hasbarBtnBgColor":{"type":"string","default":"#fdd835"},"hasbarBtnTxtColor":{"type":"string"}}}');

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
/*!**************************************************!*\
  !*** ./src/blocks/hashbar-notification/index.js ***!
  \**************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./block.json */ "./src/blocks/hashbar-notification/block.json");
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








/**`
 * Register: a Gutenberg Block.
 *
*/

(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_3__.registerBlockType)(_block_json__WEBPACK_IMPORTED_MODULE_1__.name, {
  title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)(_block_json__WEBPACK_IMPORTED_MODULE_1__.title, "hashbar"),
  icon: _block_json__WEBPACK_IMPORTED_MODULE_1__.icon,
  category: _block_json__WEBPACK_IMPORTED_MODULE_1__.category,
  keywords: [..._block_json__WEBPACK_IMPORTED_MODULE_1__.keywords],
  example: {
    attributes: {
      value: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Hashbar Button', 'hashbar')
    }
  },
  attributes: _block_json__WEBPACK_IMPORTED_MODULE_1__.attributes,
  edit: ({
    attributes,
    setAttributes,
    className,
    isSelected
  }) => {
    const alignmentClass = attributes.textAlignment != null ? 'has-text-align-' + attributes.textAlignment : '';
    const onChangBtnText = newBtnText => {
      const newhasbarButton = {
        ...attributes.hasbarButton
      };
      newhasbarButton.text = newBtnText;
      setAttributes({
        hasbarButton: newhasbarButton
      });
    };
    const onChangBtnLink = newBtnLink => {
      const newhasbarButton = {
        ...attributes.hasbarButton
      };
      if (newBtnLink.search('javascript:') >= 0) {
        newhasbarButton.link = '#';
      } else {
        newhasbarButton.link = newBtnLink;
      }
      setAttributes({
        hasbarButton: newhasbarButton
      });
    };
    let buttonLinkFilterd = '';
    if (attributes.hasbarButton.link.search('javascript:') >= 0) {
      buttonLinkFilterd = '#';
      const newhasbarButton = {
        ...attributes.hasbarButton
      };
      newhasbarButton.link = '#';
      setAttributes({
        hasbarButton: newhasbarButton
      });
    } else {
      buttonLinkFilterd = attributes.hasbarButton.link;
    }
    const ToggleButton = (btnState, btnAttr) => {
      let changeBtnValue = btnState === 'yes' ? 'no' : 'yes';
      if (btnAttr === 'hashbarBtnRemove') {
        setAttributes({
          hashbarBtnRemove: changeBtnValue
        });
      } else if (btnAttr === 'hashbarBtnNofollow') {
        setAttributes({
          hashbarBtnNofollow: changeBtnValue
        });
      } else if (btnAttr === 'hashbarBtnSponsor') {
        setAttributes({
          hashbarBtnSponsor: changeBtnValue
        });
      } else if (btnAttr === 'hashbarBtnNewTab') {
        setAttributes({
          hashbarBtnNewTab: changeBtnValue
        });
      }
    };
    const onChangeBtnFontSize = newFontSize => {
      setAttributes({
        hasbarBtnFontSize: parseInt(newFontSize)
      });
    };
    const onChangeBtnBordeRadius = newBorderRadius => {
      setAttributes({
        BtnBorderRadius: parseInt(newBorderRadius)
      });
    };
    const onChangeBtnMarginTop = newMarginTop => {
      setAttributes({
        BtnMarginTop: parseInt(newMarginTop)
      });
    };
    const onChangeBtnMarginRight = newMarginRight => {
      setAttributes({
        BtnMarginRight: parseInt(newMarginRight)
      });
    };
    const onChangeBtnMarginBottom = newMarginBottom => {
      setAttributes({
        BtnMarginBottom: parseInt(newMarginBottom)
      });
    };
    const onChangeBtnMarginLeft = newMarginLeft => {
      setAttributes({
        BtnMarginLeft: parseInt(newMarginLeft)
      });
    };
    const onChangeBtnPaddingTop = newPaddingTop => {
      setAttributes({
        BtnPaddingTop: parseInt(newPaddingTop)
      });
    };
    const onChangeBtnPaddingRight = newPaddingRight => {
      setAttributes({
        BtnPaddingRight: parseInt(newPaddingRight)
      });
    };
    const onChangeBtnPaddingBottom = newPaddingBottom => {
      setAttributes({
        BtnPaddingBottom: parseInt(newPaddingBottom)
      });
    };
    const onChangeBtnPaddingLeft = newPaddingLeft => {
      setAttributes({
        BtnPaddingLeft: parseInt(newPaddingLeft)
      });
    };
    const onChangeContent = newContent => {
      setAttributes({
        hashbarContent: newContent
      });
    };
    const onChangeBtnMargin = newBtnMargin => {
      setAttributes({
        hashbarBtnMargin: newBtnMargin
      });
    };
    const onChangeButnBgColor = newBtnBgColor => {
      setAttributes({
        hasbarBtnBgColor: newBtnBgColor
      });
    };
    const onCnangeBtnTxtColor = newBtnTxtColor => {
      setAttributes({
        hasbarBtnTxtColor: newBtnTxtColor
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
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_4__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
      title: "Button Settings",
      className: "hashbar-block-panel"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item btn-appear-wrap",
      style: {
        marginBottom: 30
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      htmlFor: "switch-btn-enable"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Button Enable', 'hashbar')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FormToggle, {
      id: "switch-btn-enable",
      checked: attributes.hashbarBtnRemove === 'yes',
      onChange: () => ToggleButton(attributes.hashbarBtnRemove, 'hashbarBtnRemove')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item btn-appear-wrap",
      style: {
        marginBottom: 30
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      htmlFor: "btn-no-follow"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Nofollow', 'hashbar')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FormToggle, {
      id: "btn-no-follow",
      checked: attributes.hashbarBtnNofollow === 'yes',
      onChange: () => ToggleButton(attributes.hashbarBtnNofollow, 'hashbarBtnNofollow')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item btn-appear-wrap",
      style: {
        marginBottom: 30
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      htmlFor: "btn-sponsored"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Sponsored', 'hashbar')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FormToggle, {
      id: "btn-sponsored",
      checked: attributes.hashbarBtnSponsor === 'yes',
      onChange: () => ToggleButton(attributes.hashbarBtnSponsor, 'hashbarBtnSponsor')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Text", "hashbar"),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("give button name", "hashbar"),
      value: attributes.hasbarButton.text,
      onChange: onChangBtnText,
      style: {
        marginBottom: 20
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Link", "hashbar"),
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Link", "hashbar"),
      value: attributes.hasbarButton.link,
      onChange: onChangBtnLink,
      style: {
        marginBottom: 20
      }
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item btn-appear-wrap",
      style: {
        marginBottom: 30
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("label", {
      htmlFor: "open-link-in-new-tab"
    }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Open link in new tab', 'hashbar')), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.FormToggle, {
      id: "open-link-in-new-tab",
      checked: attributes.hashbarBtnNewTab === 'yes',
      onChange: () => ToggleButton(attributes.hashbarBtnNewTab, 'hashbarBtnNewTab')
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Margin (PX)", "hashbar")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "btn-margin-set",
      style: {
        display: "flex"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("top", "hashbar"),
      type: "number",
      value: attributes.BtnMarginTop,
      onChange: onChangeBtnMarginTop
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("right", "hashbar"),
      type: "number",
      value: attributes.BtnMarginRight,
      onChange: onChangeBtnMarginRight
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("bottom", "hashbar"),
      type: "number",
      value: attributes.BtnMarginBottom,
      onChange: onChangeBtnMarginBottom
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("left", "hashbar"),
      type: "number",
      value: attributes.BtnMarginLeft,
      onChange: onChangeBtnMarginLeft
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Padding (PX)", "hashbar")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "btn-margin-set",
      style: {
        display: "flex"
      }
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: "top",
      type: "number",
      value: attributes.BtnPaddingTop,
      onChange: onChangeBtnPaddingTop
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: "right",
      type: "number",
      value: attributes.BtnPaddingRight,
      onChange: onChangeBtnPaddingRight
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: "bottom",
      type: "number",
      value: attributes.BtnPaddingBottom,
      onChange: onChangeBtnPaddingBottom
    }), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
      help: "left",
      type: "number",
      value: attributes.BtnPaddingLeft,
      onChange: onChangeBtnPaddingLeft
    }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Border Radius (PX)", "hashbar")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.RangeControl, {
      value: attributes.BtnBorderRadius,
      onChange: onChangeBtnBordeRadius
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Font Size (PX)", "hashbar")), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.RangeControl, {
      value: attributes.hasbarBtnFontSize,
      onChange: onChangeBtnFontSize
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Background Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      value: attributes.hasbarBtnBgColor,
      onChange: onChangeButnBgColor
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: "panel-item panel-color-control"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("strong", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)("Text Color", "hashbar"))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.ColorPalette, {
      value: attributes.hasbarBtnTxtColor,
      onChange: onCnangeBtnTxtColor
    })))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.BlockControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.AlignmentToolbar, {
      value: attributes.textAlignment,
      onChange: newalign => setAttributes({
        textAlignment: newalign
      })
    })), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      ...(0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.useBlockProps)()
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText, {
      className: className,
      value: attributes.hashbarContent,
      onChange: onChangeContent,
      placeholder: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_2__.__)('Add Your Text Here', "hashbar"),
      style: {
        margin: "0px",
        padding: "0px",
        display: "inline-block"
      }
    }), attributes.hashbarBtnRemove === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      className: "ht_btn",
      href: buttonLinkFilterd,
      style: {
        backgroundColor: attributes.hasbarBtnBgColor,
        color: attributes.hasbarBtnTxtColor,
        marginTop: attributes.BtnMarginTop + "px",
        marginRight: attributes.BtnMarginRight + "px",
        marginBottom: attributes.BtnMarginBottom + "px",
        marginLeft: attributes.BtnMarginLeft + "px",
        paddingTop: attributes.BtnPaddingTop + "px",
        paddingRight: attributes.BtnPaddingRight + "px",
        paddingBottom: attributes.BtnPaddingBottom + "px",
        paddingLeft: attributes.BtnPaddingLeft + "px",
        borderRadius: attributes.BtnBorderRadius + "px",
        fontSize: attributes.hasbarBtnFontSize + "px"
      }
    }, attributes.hasbarButton.text) : ""));
  },
  save: ({
    attributes
  }) => {
    const alignmentClass = attributes.textAlignment != null ? 'has-text-align-' + attributes.textAlignment : '';
    let relAttr = '';
    if (attributes.hashbarBtnNofollow == 'yes') {
      relAttr += 'nofollow ';
    }
    if (attributes.hashbarBtnSponsor == 'yes') {
      relAttr += 'sponsored';
    }
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
      className: alignmentClass + " hashbar-free-wraper"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText.Content, {
      tagName: "p",
      value: attributes.hashbarContent
    }), attributes.hashbarBtnRemove === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
      className: "ht_btn",
      href: attributes.hasbarButton.link,
      ...(relAttr !== '' ? {
        rel: relAttr
      } : {}),
      target: attributes.hashbarBtnNewTab === 'yes' ? '_blank' : undefined,
      style: {
        backgroundColor: attributes.hasbarBtnBgColor,
        color: attributes.hasbarBtnTxtColor,
        marginTop: attributes.BtnMarginTop + "px",
        marginRight: attributes.BtnMarginRight + "px",
        marginBottom: attributes.BtnMarginBottom + "px",
        marginLeft: attributes.BtnMarginLeft + "px",
        paddingTop: attributes.BtnPaddingTop + "px",
        paddingRight: attributes.BtnPaddingRight + "px",
        paddingBottom: attributes.BtnPaddingBottom + "px",
        paddingLeft: attributes.BtnPaddingLeft + "px",
        borderRadius: attributes.BtnBorderRadius + "px",
        fontSize: attributes.hasbarBtnFontSize + "px"
      }
    }, attributes.hasbarButton.text) : "");
  },
  deprecated: [{
    attributes: {
      textAlignment: {
        type: "string"
      },
      hasbarButton: {
        type: "object",
        default: {
          text: "Button",
          link: "#"
        }
      },
      hasbarBtnFontSize: {
        type: "number",
        default: 18
      },
      hashbarBtnRemove: {
        type: "string",
        default: "yes"
      },
      hashbarBtnNofollow: {
        type: "string",
        default: "no"
      },
      hashbarBtnSponsor: {
        type: "string",
        default: "no"
      },
      hashbarContent: {
        type: "string"
      },
      BtnBorderRadius: {
        type: "number",
        default: 3
      },
      BtnMarginTop: {
        type: "number",
        default: 0
      },
      BtnMarginRight: {
        type: "number",
        default: 20
      },
      BtnMarginBottom: {
        type: "number",
        default: 0
      },
      BtnMarginLeft: {
        type: "number",
        default: 20
      },
      BtnPaddingTop: {
        type: "number",
        default: 10
      },
      BtnPaddingRight: {
        type: "number",
        default: 30
      },
      BtnPaddingBottom: {
        type: "number",
        default: 10
      },
      BtnPaddingLeft: {
        type: "number",
        default: 30
      },
      hasbarBtnBgColor: {
        type: "string",
        default: "#fdd835"
      },
      hasbarBtnTxtColor: {
        type: "string"
      }
    },
    save: ({
      attributes
    }) => {
      const alignmentClass = attributes.textAlignment != null ? 'has-text-align-' + attributes.textAlignment : '';
      let relAttr = '';
      if (attributes.hashbarBtnNofollow == 'yes') {
        relAttr += 'nofollow ';
      }
      if (attributes.hashbarBtnSponsor == 'yes') {
        relAttr += 'sponsored';
      }
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: alignmentClass + " hashbar-free-wraper"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText.Content, {
        tagName: "p",
        value: attributes.hashbarContent
      }), attributes.hashbarBtnRemove === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
        className: "ht_btn",
        href: attributes.hasbarButton.link,
        ...(relAttr !== '' ? {
          rel: relAttr
        } : {}),
        style: {
          backgroundColor: attributes.hasbarBtnBgColor,
          color: attributes.hasbarBtnTxtColor,
          marginTop: attributes.BtnMarginTop + "px",
          marginRight: attributes.BtnMarginRight + "px",
          marginBottom: attributes.BtnMarginBottom + "px",
          marginLeft: attributes.BtnMarginLeft + "px",
          paddingTop: attributes.BtnPaddingTop + "px",
          paddingRight: attributes.BtnPaddingRight + "px",
          paddingBottom: attributes.BtnPaddingBottom + "px",
          paddingLeft: attributes.BtnPaddingLeft + "px",
          borderRadius: attributes.BtnBorderRadius + "px",
          fontSize: attributes.hasbarBtnFontSize + "px"
        }
      }, attributes.hasbarButton.text) : "");
    }
  }, {
    attributes: {
      textAlignment: {
        type: "string"
      },
      hasbarButton: {
        type: "object",
        default: {
          "text": "Button",
          "link": "#"
        }
      },
      hasbarBtnFontSize: {
        type: "number",
        default: 18
      },
      hashbarBtnRemove: {
        type: "string",
        default: "yes"
      },
      hashbarContent: {
        type: "string"
      },
      BtnBorderRadius: {
        type: "number",
        default: 3
      },
      BtnMarginTop: {
        type: "number",
        default: 0
      },
      BtnMarginRight: {
        type: "number",
        default: 20
      },
      BtnMarginBottom: {
        type: "number",
        default: 0
      },
      BtnMarginLeft: {
        type: "number",
        default: 20
      },
      BtnPaddingTop: {
        type: "number",
        default: 10
      },
      BtnPaddingRight: {
        type: "number",
        default: 30
      },
      BtnPaddingBottom: {
        type: "number",
        default: 10
      },
      BtnPaddingLeft: {
        type: "number",
        default: 30
      },
      hasbarBtnBgColor: {
        type: "string",
        default: "#fdd835"
      },
      hasbarBtnTxtColor: {
        type: "string"
      }
    },
    save: props => {
      const alignmentClass = props.attributes.textAlignment != null ? 'has-text-align-' + props.attributes.textAlignment : '';
      return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
        className: alignmentClass + " hashbar-free-wraper"
      }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_6__.RichText.Content, {
        tagName: "p",
        value: props.attributes.hashbarContent
      }), props.attributes.hashbarBtnRemove === 'yes' ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
        className: "ht_btn",
        href: props.attributes.hasbarButton.link,
        style: {
          backgroundColor: props.attributes.hasbarBtnBgColor,
          color: props.attributes.hasbarBtnTxtColor,
          marginTop: props.attributes.BtnMarginTop + "px",
          marginRight: props.attributes.BtnMarginRight + "px",
          marginBottom: props.attributes.BtnMarginBottom + "px",
          marginLeft: props.attributes.BtnMarginLeft + "px",
          paddingTop: props.attributes.BtnPaddingTop + "px",
          paddingRight: props.attributes.BtnPaddingRight + "px",
          paddingBottom: props.attributes.BtnPaddingBottom + "px",
          paddingLeft: props.attributes.BtnPaddingLeft + "px",
          borderRadius: props.attributes.BtnBorderRadius + "px",
          fontSize: props.attributes.hasbarBtnFontSize + "px"
        }
      }, props.attributes.hasbarButton.text) : "");
    }
  }]
});
})();

/******/ })()
;
//# sourceMappingURL=index.js.map