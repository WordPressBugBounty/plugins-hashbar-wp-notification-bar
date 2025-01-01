(()=>{"use strict";var e={1020:(e,t,n)=>{var a=n(1609),r=Symbol.for("react.element"),l=(Symbol.for("react.fragment"),Object.prototype.hasOwnProperty),o=a.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner,i={key:!0,ref:!0,__self:!0,__source:!0};t.jsx=function(e,t,n){var a,s={},h=null,p=null;for(a in void 0!==n&&(h=""+n),void 0!==t.key&&(h=""+t.key),void 0!==t.ref&&(p=t.ref),t)l.call(t,a)&&!i.hasOwnProperty(a)&&(s[a]=t[a]);if(e&&e.defaultProps)for(a in t=e.defaultProps)void 0===s[a]&&(s[a]=t[a]);return{$$typeof:r,type:e,key:h,ref:p,props:s,_owner:o.current}}},4848:(e,t,n)=>{e.exports=n(1020)},1609:e=>{e.exports=window.React}},t={};function n(a){var r=t[a];if(void 0!==r)return r.exports;var l=t[a]={exports:{}};return e[a](l,l.exports,n),l.exports}var a=n(1609);const r=JSON.parse('{"UU":"hashbar/hashbar-button","DD":"Hashbar Notification","Kk":"info","L1":"hashbar-blocks","RE":["hashbar","button","notification"],"uK":{"id":{"type":"string"},"textAlignment":{"type":"string"},"contentFont":{"type":"string"},"contentSize":{"type":"number"},"contentWeight":{"type":"string"},"contentLineHeight":{"type":"number"},"contentLetterSpacing":{"type":"number"},"contentDecoration":{"type":"string"},"contentTransform":{"type":"string"},"contentColor":{"type":"string"},"hasbarBtnFontSize":{"type":"number","default":18},"btnWeight":{"type":"string"},"btnLineHeight":{"type":"number"},"btnLetterSpacing":{"type":"number"},"btnDecoration":{"type":"string"},"btnTransform":{"type":"string"},"hasbarButton":{"type":"object","default":{"text":"Button","link":"#"}},"hashbarBtnRemove":{"type":"string","default":"yes"},"hashbarBtnNofollow":{"type":"string","default":"no"},"hashbarBtnSponsor":{"type":"string","default":"no"},"hashbarBtnNewTab":{"type":"string","default":"no"},"hashbarContent":{"type":"string","default":"New Year, New Savings: Mega Bundle Upgrade Offer! Only <strong>$159</strong>"},"BtnBorderRadius":{"type":"number","default":3},"BtnMarginTop":{"type":"number","default":0},"BtnMarginRight":{"type":"number","default":20},"BtnMarginBottom":{"type":"number","default":0},"BtnMarginLeft":{"type":"number","default":20},"BtnPaddingTop":{"type":"number","default":10},"BtnPaddingRight":{"type":"number","default":30},"BtnPaddingBottom":{"type":"number","default":10},"BtnPaddingLeft":{"type":"number","default":30},"hasbarBtnBgColor":{"type":"string","default":"#fdd835"},"hasbarBtnTxtColor":{"type":"string"}}}'),l=window.wp.i18n,o=window.wp.blocks,i=window.wp.element,s=window.wp.components,h=window.wp.blockEditor,p=window.wp.primitives;var g=n(4848);const m=(0,g.jsx)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,g.jsx)(p.Path,{d:"M9 9v6h11V9H9zM4 20h1.5V4H4v16z"})}),b=(0,g.jsx)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,g.jsx)(p.Path,{d:"M12.5 15v5H11v-5H4V9h7V4h1.5v5h7v6h-7Z"})}),u=(0,g.jsx)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,g.jsx)(p.Path,{d:"M4 15h11V9H4v6zM18.5 4v16H20V4h-1.5z"})}),c=(0,g.jsx)(p.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24",children:(0,g.jsx)(p.Path,{d:"M9 15h6V9H9v6zm-5 5h1.5V4H4v16zM18.5 4v16H20V4h-1.5z"})}),d=[{attributes:{textAlignment:{type:"string"},hasbarButton:{type:"object",default:{text:"Button",link:"#"}},hasbarBtnFontSize:{type:"number",default:18},hashbarBtnRemove:{type:"string",default:"yes"},hashbarBtnNofollow:{type:"string",default:"no"},hashbarBtnSponsor:{type:"string",default:"no"},hashbarBtnNewTab:{type:"string",default:"no"},hashbarContent:{type:"string"},BtnBorderRadius:{type:"number",default:3},BtnMarginTop:{type:"number",default:0},BtnMarginRight:{type:"number",default:20},BtnMarginBottom:{type:"number",default:0},BtnMarginLeft:{type:"number",default:20},BtnPaddingTop:{type:"number",default:10},BtnPaddingRight:{type:"number",default:30},BtnPaddingBottom:{type:"number",default:10},BtnPaddingLeft:{type:"number",default:30},hasbarBtnBgColor:{type:"string",default:"#fdd835"},hasbarBtnTxtColor:{type:"string"}},save:({attributes:e})=>{const t=null!=e.textAlignment?"has-text-align-"+e.textAlignment:"";let n="";return"yes"==e.hashbarBtnNofollow&&(n+="nofollow "),"yes"==e.hashbarBtnSponsor&&(n+="sponsored"),(0,a.createElement)("div",{className:t+" hashbar-free-wraper"},(0,a.createElement)(h.RichText.Content,{tagName:"p",value:e.hashbarContent}),"yes"===e.hashbarBtnRemove?(0,a.createElement)("a",{className:"ht_btn",href:e.hasbarButton.link,...""!==n?{rel:n}:{},target:"yes"===e.hashbarBtnNewTab?"_blank":void 0,style:{backgroundColor:e.hasbarBtnBgColor,color:e.hasbarBtnTxtColor,marginTop:e.BtnMarginTop+"px",marginRight:e.BtnMarginRight+"px",marginBottom:e.BtnMarginBottom+"px",marginLeft:e.BtnMarginLeft+"px",paddingTop:e.BtnPaddingTop+"px",paddingRight:e.BtnPaddingRight+"px",paddingBottom:e.BtnPaddingBottom+"px",paddingLeft:e.BtnPaddingLeft+"px",borderRadius:e.BtnBorderRadius+"px",fontSize:e.hasbarBtnFontSize+"px"}},e.hasbarButton.text):"")}},{attributes:{textAlignment:{type:"string"},hasbarButton:{type:"object",default:{text:"Button",link:"#"}},hasbarBtnFontSize:{type:"number",default:18},hashbarBtnRemove:{type:"string",default:"yes"},hashbarBtnNofollow:{type:"string",default:"no"},hashbarBtnSponsor:{type:"string",default:"no"},hashbarContent:{type:"string"},BtnBorderRadius:{type:"number",default:3},BtnMarginTop:{type:"number",default:0},BtnMarginRight:{type:"number",default:20},BtnMarginBottom:{type:"number",default:0},BtnMarginLeft:{type:"number",default:20},BtnPaddingTop:{type:"number",default:10},BtnPaddingRight:{type:"number",default:30},BtnPaddingBottom:{type:"number",default:10},BtnPaddingLeft:{type:"number",default:30},hasbarBtnBgColor:{type:"string",default:"#fdd835"},hasbarBtnTxtColor:{type:"string"}},save:({attributes:e})=>{const t=null!=e.textAlignment?"has-text-align-"+e.textAlignment:"";let n="";return"yes"==e.hashbarBtnNofollow&&(n+="nofollow "),"yes"==e.hashbarBtnSponsor&&(n+="sponsored"),(0,a.createElement)("div",{className:t+" hashbar-free-wraper"},(0,a.createElement)(h.RichText.Content,{tagName:"p",value:e.hashbarContent}),"yes"===e.hashbarBtnRemove?(0,a.createElement)("a",{className:"ht_btn",href:e.hasbarButton.link,...""!==n?{rel:n}:{},style:{backgroundColor:e.hasbarBtnBgColor,color:e.hasbarBtnTxtColor,marginTop:e.BtnMarginTop+"px",marginRight:e.BtnMarginRight+"px",marginBottom:e.BtnMarginBottom+"px",marginLeft:e.BtnMarginLeft+"px",paddingTop:e.BtnPaddingTop+"px",paddingRight:e.BtnPaddingRight+"px",paddingBottom:e.BtnPaddingBottom+"px",paddingLeft:e.BtnPaddingLeft+"px",borderRadius:e.BtnBorderRadius+"px",fontSize:e.hasbarBtnFontSize+"px"}},e.hasbarButton.text):"")}},{attributes:{textAlignment:{type:"string"},hasbarButton:{type:"object",default:{text:"Button",link:"#"}},hasbarBtnFontSize:{type:"number",default:18},hashbarBtnRemove:{type:"string",default:"yes"},hashbarContent:{type:"string"},BtnBorderRadius:{type:"number",default:3},BtnMarginTop:{type:"number",default:0},BtnMarginRight:{type:"number",default:20},BtnMarginBottom:{type:"number",default:0},BtnMarginLeft:{type:"number",default:20},BtnPaddingTop:{type:"number",default:10},BtnPaddingRight:{type:"number",default:30},BtnPaddingBottom:{type:"number",default:10},BtnPaddingLeft:{type:"number",default:30},hasbarBtnBgColor:{type:"string",default:"#fdd835"},hasbarBtnTxtColor:{type:"string"}},save:e=>{const t=null!=e.attributes.textAlignment?"has-text-align-"+e.attributes.textAlignment:"";return(0,a.createElement)("div",{className:t+" hashbar-free-wraper"},(0,a.createElement)(h.RichText.Content,{tagName:"p",value:e.attributes.hashbarContent}),"yes"===e.attributes.hashbarBtnRemove?(0,a.createElement)("a",{className:"ht_btn",href:e.attributes.hasbarButton.link,style:{backgroundColor:e.attributes.hasbarBtnBgColor,color:e.attributes.hasbarBtnTxtColor,marginTop:e.attributes.BtnMarginTop+"px",marginRight:e.attributes.BtnMarginRight+"px",marginBottom:e.attributes.BtnMarginBottom+"px",marginLeft:e.attributes.BtnMarginLeft+"px",paddingTop:e.attributes.BtnPaddingTop+"px",paddingRight:e.attributes.BtnPaddingRight+"px",paddingBottom:e.attributes.BtnPaddingBottom+"px",paddingLeft:e.attributes.BtnPaddingLeft+"px",borderRadius:e.attributes.BtnBorderRadius+"px",fontSize:e.attributes.hasbarBtnFontSize+"px"}},e.attributes.hasbarButton.text):"")}}];(0,o.registerBlockType)(r.UU,{title:(0,l.__)(r.DD,"hashbar"),icon:r.Kk,category:r.L1,keywords:[...r.RE],example:{attributes:{value:(0,l.__)("Hashbar Button","hashbar")}},attributes:r.uK,edit:({clientId:e,attributes:t,setAttributes:n,className:r,isSelected:o})=>{const p=null!=t.textAlignment?"has-text-align-"+t.textAlignment:"",g=[{icon:m,title:"Align Left",align:"left"},{icon:b,title:"Align Center",align:"center"},{icon:u,title:"Align Right",align:"right"},{icon:c,title:"Space Between",align:"space-between"}];let d="";if(t.hasbarButton.link.search("javascript:")>=0){d="#";const e={...t.hasbarButton};e.link="#",n({hasbarButton:e})}else d=t.hasbarButton.link;const B=(e,t)=>{let a="yes"===e?"no":"yes";"hashbarBtnRemove"===t?n({hashbarBtnRemove:a}):"hashbarBtnNofollow"===t?n({hashbarBtnNofollow:a}):"hashbarBtnSponsor"===t?n({hashbarBtnSponsor:a}):"hashbarBtnNewTab"===t&&n({hashbarBtnNewTab:a})},f={fontSize:t?.contentSize?t?.contentSize+"px":null,fontWeight:t?.contentWeight&&"default"!==t?.contentWeight?t?.contentWeight:null,lineHeight:t?.contentLineHeight?t?.contentLineHeight+"px":null,letterSpacing:t?.contentLetterSpacing?t?.contentLetterSpacing+"px":null,textDecoration:t?.contentDecoration?t?.contentDecoration:null,textTransform:t?.contentTransform&&"default"!==t?.contentTransform?t?.contentTransform:null,color:t?.contentColor?t?.contentColor:null},x={fontSize:t?.hasbarBtnFontSize+"px",fontWeight:t?.btnWeight&&"default"!==t?.btnWeight?t?.btnWeight:null,lineHeight:t?.btnLineHeight?t?.btnLineHeight+"px":null,letterSpacing:t?.btnLetterSpacing?t?.btnLetterSpacing+"px":null,textDecoration:t?.btnDecoration?t?.btnDecoration:null,textTransform:t?.btnTransform&&"default"!==t?.btnTransform?t?.btnTransform:null,marginTop:t.BtnMarginTop+"px",marginRight:t.BtnMarginRight+"px",marginBottom:t.BtnMarginBottom+"px",marginLeft:t.BtnMarginLeft+"px",paddingTop:t.BtnPaddingTop+"px",paddingRight:t.BtnPaddingRight+"px",paddingBottom:t.BtnPaddingBottom+"px",paddingLeft:t.BtnPaddingLeft+"px",borderRadius:t.BtnBorderRadius+"px",backgroundColor:t.hasbarBtnBgColor,color:t.hasbarBtnTxtColor};return(0,a.createElement)(i.Fragment,null,(0,a.createElement)(h.InspectorControls,null,(0,a.createElement)(s.PanelBody,{title:"Content Settings",className:"hashbar-block-panel"},(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Font Size (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.contentSize,onChange:e=>n({contentSize:parseInt(e)}),min:1})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Font Weight","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.contentWeight,options:[{label:"Default",value:"default"},{label:"300",value:"300"},{label:"400",value:"400"},{label:"500",value:"500"},{label:"600",value:"600"},{label:"700",value:"700"}],onChange:e=>n({contentWeight:e})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Line Height (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.contentLineHeight,onChange:e=>n({contentLineHeight:parseInt(e)})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Letter Spacing (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.contentLetterSpacing,onChange:e=>n({contentLetterSpacing:e}),step:.1,max:10,min:0})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Text Decoration","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.contentDecoration,options:[{label:"None",value:"none"},{label:"Underline",value:"underline"},{label:"Line Through",value:"line-through"},{label:"Overline",value:"overline"}],onChange:e=>n({contentDecoration:e})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Text Transform","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.contentTransform,options:[{label:"Default",value:"default"},{label:"Capitalize",value:"capitalize"},{label:"Lowercase",value:"lowercase"},{label:"Uppercase",value:"uppercase"}],onChange:e=>n({contentTransform:e})})),(0,a.createElement)("div",{className:"panel-item panel-color-control"},(0,a.createElement)("p",null,(0,l.__)("Color","hashbar")),(0,a.createElement)(h.ColorPalette,{value:t.contentColor,onChange:e=>n({contentColor:e})}))),(0,a.createElement)(s.PanelBody,{title:"Button Settings",className:"hashbar-block-panel",initialOpen:!1},(0,a.createElement)("div",{className:"panel-item btn-appear-wrap",style:{marginBottom:30}},(0,a.createElement)("label",{htmlFor:"switch-btn-enable"},(0,l.__)("Button Enable","hashbar")),(0,a.createElement)(s.FormToggle,{id:"switch-btn-enable",checked:"yes"===t.hashbarBtnRemove,onChange:()=>B(t.hashbarBtnRemove,"hashbarBtnRemove")})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)(s.TextControl,{label:(0,l.__)("Text","hashbar"),placeholder:(0,l.__)("give button name","hashbar"),value:t.hasbarButton.text,onChange:e=>{const a={...t.hasbarButton};a.text=e,n({hasbarButton:a})},style:{marginBottom:20}})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)(s.TextControl,{label:(0,l.__)("Link","hashbar"),placeholder:(0,l.__)("Link","hashbar"),value:t.hasbarButton.link,onChange:e=>{const a={...t.hasbarButton};e.search("javascript:")>=0?a.link="#":a.link=e,n({hasbarButton:a})},style:{marginBottom:20}})),(0,a.createElement)("div",{className:"panel-item btn-appear-wrap",style:{marginBottom:30}},(0,a.createElement)("label",{htmlFor:"btn-no-follow"},(0,l.__)("Nofollow","hashbar")),(0,a.createElement)(s.FormToggle,{id:"btn-no-follow",checked:"yes"===t.hashbarBtnNofollow,onChange:()=>B(t.hashbarBtnNofollow,"hashbarBtnNofollow")})),(0,a.createElement)("div",{className:"panel-item btn-appear-wrap",style:{marginBottom:30}},(0,a.createElement)("label",{htmlFor:"btn-sponsored"},(0,l.__)("Sponsored","hashbar")),(0,a.createElement)(s.FormToggle,{id:"btn-sponsored",checked:"yes"===t.hashbarBtnSponsor,onChange:()=>B(t.hashbarBtnSponsor,"hashbarBtnSponsor")})),(0,a.createElement)("div",{className:"panel-item btn-appear-wrap",style:{marginBottom:30}},(0,a.createElement)("label",{htmlFor:"open-link-in-new-tab"},(0,l.__)("Open link in new tab","hashbar")),(0,a.createElement)(s.FormToggle,{id:"open-link-in-new-tab",checked:"yes"===t.hashbarBtnNewTab,onChange:()=>B(t.hashbarBtnNewTab,"hashbarBtnNewTab")})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Font Size (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.hasbarBtnFontSize,onChange:e=>n({hasbarBtnFontSize:parseInt(e)}),min:1})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Font Weight","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.btnWeight,options:[{label:"Default",value:"default"},{label:"300",value:"300"},{label:"400",value:"400"},{label:"500",value:"500"},{label:"600",value:"600"},{label:"700",value:"700"}],onChange:e=>n({btnWeight:e})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Line Height (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.btnLineHeight,onChange:e=>n({btnLineHeight:parseInt(e)})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Letter Spacing (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.btnLetterSpacing,onChange:e=>n({btnLetterSpacing:e}),step:.1,max:10,min:0})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Text Decoration","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.btnDecoration,options:[{label:"None",value:"none"},{label:"Underline",value:"underline"},{label:"Line Through",value:"line-through"},{label:"Overline",value:"overline"}],onChange:e=>n({btnDecoration:e})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Text Transform","hashbar")),(0,a.createElement)(s.SelectControl,{value:t.btnTransform,options:[{label:"Default",value:"default"},{label:"Capitalize",value:"capitalize"},{label:"Lowercase",value:"lowercase"},{label:"Uppercase",value:"uppercase"}],onChange:e=>n({btnTransform:e})})),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Margin (PX)","hashbar")),(0,a.createElement)("div",{className:"btn-margin-set",style:{display:"flex"}},(0,a.createElement)(s.TextControl,{help:(0,l.__)("top","hashbar"),type:"number",value:t.BtnMarginTop,onChange:e=>{n({BtnMarginTop:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:(0,l.__)("right","hashbar"),type:"number",value:t.BtnMarginRight,onChange:e=>{n({BtnMarginRight:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:(0,l.__)("bottom","hashbar"),type:"number",value:t.BtnMarginBottom,onChange:e=>{n({BtnMarginBottom:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:(0,l.__)("left","hashbar"),type:"number",value:t.BtnMarginLeft,onChange:e=>{n({BtnMarginLeft:parseInt(e)})}}))),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Padding (PX)","hashbar")),(0,a.createElement)("div",{className:"btn-margin-set",style:{display:"flex"}},(0,a.createElement)(s.TextControl,{help:"top",type:"number",value:t.BtnPaddingTop,onChange:e=>{n({BtnPaddingTop:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:"right",type:"number",value:t.BtnPaddingRight,onChange:e=>{n({BtnPaddingRight:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:"bottom",type:"number",value:t.BtnPaddingBottom,onChange:e=>{n({BtnPaddingBottom:parseInt(e)})}}),(0,a.createElement)(s.TextControl,{help:"left",type:"number",value:t.BtnPaddingLeft,onChange:e=>{n({BtnPaddingLeft:parseInt(e)})}}))),(0,a.createElement)("div",{className:"panel-item"},(0,a.createElement)("p",null,(0,l.__)("Border Radius (PX)","hashbar")),(0,a.createElement)(s.RangeControl,{value:t.BtnBorderRadius,onChange:e=>{n({BtnBorderRadius:parseInt(e)})}})),(0,a.createElement)("div",{className:"panel-item panel-color-control"},(0,a.createElement)("p",null,(0,l.__)("Text Color","hashbar")),(0,a.createElement)(h.ColorPalette,{value:t.hasbarBtnTxtColor,onChange:e=>{n({hasbarBtnTxtColor:e})}})),(0,a.createElement)("div",{className:"panel-item panel-color-control"},(0,a.createElement)("p",null,(0,l.__)("Background Color","hashbar")),(0,a.createElement)(h.ColorPalette,{value:t.hasbarBtnBgColor,onChange:e=>{n({hasbarBtnBgColor:e})}})))),(0,a.createElement)(h.BlockControls,null,(0,a.createElement)(h.AlignmentToolbar,{alignmentControls:g,value:t.textAlignment,onChange:e=>n({textAlignment:e})})),(0,a.createElement)("div",{...(0,h.useBlockProps)({className:p,style:{display:"flex",flexDirection:"row",alignItems:"center"}})},(0,a.createElement)(h.RichText,{tagName:"p",className:r,value:t.hashbarContent,onChange:e=>{n({hashbarContent:e})},placeholder:(0,l.__)("Add Your Text Here","hashbar"),keepPlaceholderOnFocus:!0,style:{margin:"0px",padding:"0px",display:"inline-block",...f}}),"yes"===t.hashbarBtnRemove?(0,a.createElement)("a",{className:"ht_btn",style:x},t.hasbarButton.text):""))},save:({attributes:e})=>{const t=null!=e.textAlignment?"has-text-align-"+e.textAlignment:"";let n="";"yes"==e.hashbarBtnNofollow&&(n+="nofollow "),"yes"==e.hashbarBtnSponsor&&(n+="sponsored");const r={fontSize:e?.contentSize?e?.contentSize+"px":null,fontWeight:e?.contentWeight&&"default"!==e?.contentWeight?e?.contentWeight:null,lineHeight:e?.contentLineHeight?e?.contentLineHeight+"px":null,letterSpacing:e?.contentLetterSpacing?e?.contentLetterSpacing+"px":null,textDecoration:e?.contentDecoration?e?.contentDecoration:null,textTransform:e?.contentTransform&&"default"!==e?.contentTransform?e?.contentTransform:null,color:e?.contentColor?e?.contentColor:null},l={fontWeight:e?.btnWeight&&"default"!==e?.btnWeight?e?.btnWeight:null,lineHeight:e?.btnLineHeight?e?.btnLineHeight+"px":null,letterSpacing:e?.btnLetterSpacing?e?.btnLetterSpacing+"px":null,textDecoration:e?.btnDecoration?e?.btnDecoration:null,textTransform:e?.btnTransform&&"default"!==e?.btnTransform?e?.btnTransform:null,backgroundColor:e.hasbarBtnBgColor,color:e.hasbarBtnTxtColor,marginTop:e.BtnMarginTop+"px",marginRight:e.BtnMarginRight+"px",marginBottom:e.BtnMarginBottom+"px",marginLeft:e.BtnMarginLeft+"px",paddingTop:e.BtnPaddingTop+"px",paddingRight:e.BtnPaddingRight+"px",paddingBottom:e.BtnPaddingBottom+"px",paddingLeft:e.BtnPaddingLeft+"px",borderRadius:e.BtnBorderRadius+"px",fontSize:e?.hasbarBtnFontSize+"px"};return(0,a.createElement)(i.Fragment,null,(0,a.createElement)("div",{className:t+" hashbar-free-wraper"},(0,a.createElement)(h.RichText.Content,{tagName:"p",value:e.hashbarContent,style:r}),"yes"===e.hashbarBtnRemove?(0,a.createElement)("a",{className:"ht_btn",href:e.hasbarButton.link,...""!==n?{rel:n}:{},target:"yes"===e.hashbarBtnNewTab?"_blank":void 0,style:l},e.hasbarButton.text):""))},deprecated:d})})();