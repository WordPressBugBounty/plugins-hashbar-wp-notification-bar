(()=>{"use strict";const e=window.React,a=JSON.parse('{"UU":"hashbar/hashbar-promo-banner-image","DD":"Hashbar Promo Banner Image","Kk":"format-image","L1":"hashbar-blocks","RE":["hashbar","promo","banner","Image"],"uK":{"bannerBgImage":{"type":"object","default":{}},"imageLink":{"type":"string","default":"#"},"openNewTab":{"type":"string","default":"no"}}}'),t=window.wp.i18n,n=window.wp.blocks,r=window.wp.element,m=window.wp.components,l=window.wp.blockEditor,g={pluginDirUrl:hashbarBlockParams.bannerImageURL};(0,n.registerBlockType)(a.UU,{title:(0,t.__)(a.DD,"hashbar"),icon:a.Kk,category:a.L1,keywords:a.RE,example:{attributes:{value:(0,t.__)("Hashbar Promo Banner","hashbar")}},attributes:a.uK,edit:({attributes:a,setAttributes:n,className:i,isSelected:o})=>{const s=g.pluginDirUrl;let b="";a.imageLink.search("javascript:")>=0?(b="#",n({imageLink:"#"})):b=a.imageLink;const c=e=>{const t={...a.bannerBgImage};t.img_ID=e.id,t.img_url=e.url,t.img_alt=e.alt,n({bannerBgImage:t})},u=()=>{const e={...a.bannerBgImage};e.img_ID=null,e.img_url=null,e.img_alt=null,n({bannerBgImage:e})};return(0,e.createElement)(r.Fragment,null,(0,e.createElement)(l.InspectorControls,null,(0,e.createElement)(m.PanelBody,{title:"Imgage Settings"},(0,e.createElement)("div",{className:"panel-item"},(0,e.createElement)(m.TextControl,{label:(0,t.__)("Image Link","hashbar"),placeholder:(0,t.__)("Enter Link","hashbar"),value:a.imageLink,onChange:e=>{e.search("javascript:")>=0?n({imageLink:"#"}):n({imageLink:e})},style:{marginBottom:20}})),(0,e.createElement)("div",{className:"panel-item btn-appear-wrap",style:{marginBottom:20}},(0,e.createElement)("label",{htmlFor:"open-new-tab"},"Open Link In New Tab"),(0,e.createElement)(m.FormToggle,{id:"open-new-tab",checked:"yes"===a.openNewTab,onChange:()=>{let e=a.openNewTab;n({openNewTab:"yes"===e?"no":"yes"})}})))),(0,e.createElement)("div",{...(0,l.useBlockProps)()},a.bannerBgImage.img_ID?(0,e.createElement)("div",{className:"image-ctr",style:{marginBottom:20}},"yes"===a.openNewTab?(0,e.createElement)("a",{href:b,target:"_blank",rel:"noopener noreferrer"},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:s,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"auto"}})):(0,e.createElement)("a",{href:b},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:s,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"250px"}})),o?(0,e.createElement)("div",{className:"image-button-wraper"},(0,e.createElement)(l.MediaUploadCheck,null,(0,e.createElement)(l.MediaUpload,{allowedType:["image"],value:null!=a.bannerBgImage.img_ID?a.bannerBgImage.img_ID:"",onSelect:c,render:({open:a})=>(0,e.createElement)(m.Button,{className:"button-primary button-large",onClick:a,style:{marginBottom:20}},(0,t.__)("Add Image",""))})),(0,e.createElement)(m.Button,{className:"button button-large banner-image-remove",onClick:()=>u()},"Remove Image")):null):(0,e.createElement)("div",null,"yes"===a.openNewTab?(0,e.createElement)("a",{href:b,target:"_blank",rel:"noopener noreferrer"},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:s,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"auto"}})):(0,e.createElement)("a",{href:b},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:s,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"250px"}})),(0,e.createElement)("div",{className:"image-button-wraper"},(0,e.createElement)(l.MediaUploadCheck,null,(0,e.createElement)(l.MediaUpload,{allowedType:["image"],value:null!=a.bannerBgImage.img_ID?a.bannerBgImage.img_ID:"",onSelect:c,render:({open:a})=>(0,e.createElement)(m.Button,{className:"button-primary button-large",onClick:a,style:{marginBottom:20}},(0,t.__)("Add Image",""))})),(0,e.createElement)(m.Button,{className:"button button-large banner-image-remove",onClick:()=>u()},"Remove Image")))))},save:({attributes:a})=>{const t=g.pluginDirUrl;return(0,e.createElement)("div",{className:"ht-promo-banner-image"},"yes"===a.openNewTab?(0,e.createElement)("a",{href:a.imageLink,target:"_blank",rel:"noopener noreferrer"},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:t,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"auto"}})):(0,e.createElement)("a",{href:a.imageLink},(0,e.createElement)("img",{src:a.bannerBgImage.img_ID?a.bannerBgImage.img_url:t,alt:a.bannerBgImage.img_alt,style:{height:"auto",width:"250px"}})))},deprecated:[{attributes:{bannerBgImage:{type:"object",default:{}},imageLink:{type:"string",default:"#"},openNewTab:{type:"string",default:"no"}},save(a){const t=g.pluginDirUrl;return(0,e.createElement)("div",{className:"ht-promo-banner-image"},"yes"===a.attributes.openNewTab?(0,e.createElement)("a",{href:a.attributes.imageLink,target:"_blank",rel:"noopener noreferrer"},(0,e.createElement)("img",{src:a.attributes.bannerBgImage.img_ID?a.attributes.bannerBgImage.img_url:t,alt:a.attributes.bannerBgImage.img_alt,style:{height:"auto",width:"auto"}})):(0,e.createElement)("a",{href:a.attributes.imageLink},(0,e.createElement)("img",{src:a.attributes.bannerBgImage.img_ID?a.attributes.bannerBgImage.img_url:t,alt:a.attributes.bannerBgImage.img_alt,style:{height:"auto",width:"250px"}})))}}]})})();