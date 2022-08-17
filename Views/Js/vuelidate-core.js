var Vuelidate=function(e,t){"use strict";function r(e){let r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:[];return Object.keys(e).reduce((n,a)=>(r.includes(a)||(n[a]=t.unref(e[a])),n),{})}function n(e){return"function"==typeof e}function a(e){return t.isReactive(e)||t.isReadonly(e)}function u(e,r,n,a){return e.call(a,t.unref(r),t.unref(n),a)}function s(e){return void 0!==e.$valid?!e.$valid:!e}function l(e,a,l,o,i,c,$,v,d,f,p){const h=t.ref(!1),m=e.$params||{},y=t.ref(null);let g,R;e.$async?({$invalid:g,$unwatch:R}=function(e,r,n,a,l,o,i){let{$lazy:c,$rewardEarly:$}=l,v=arguments.length>7&&void 0!==arguments[7]?arguments[7]:[],d=arguments.length>8?arguments[8]:void 0,f=arguments.length>9?arguments[9]:void 0,p=arguments.length>10?arguments[10]:void 0;const h=t.ref(!!a.value),m=t.ref(0);n.value=!1;const y=t.watch([r,a].concat(v,p),()=>{if(c&&!a.value||$&&!f.value&&!n.value)return;let t;try{t=u(e,r,d,i)}catch(e){t=Promise.reject(e)}m.value++,n.value=!!m.value,h.value=!1,Promise.resolve(t).then(e=>{m.value--,n.value=!!m.value,o.value=e,h.value=s(e)}).catch(e=>{m.value--,n.value=!!m.value,o.value=e,h.value=!0})},{immediate:!0,deep:"object"==typeof r});return{$invalid:h,$unwatch:y}}(e.$validator,a,h,l,o,y,i,e.$watchTargets,d,f,p)):({$invalid:g,$unwatch:R}=function(e,r,n,a,l,o,i,c){let{$lazy:$,$rewardEarly:v}=a;return{$unwatch:()=>({}),$invalid:t.computed(()=>{if($&&!n.value||v&&!c.value)return!1;let t=!0;try{const n=u(e,r,i,o);l.value=n,t=s(n)}catch(e){l.value=e}return t})}}(e.$validator,a,l,o,y,i,d,f));const E=e.$message;return{$message:n(E)?t.computed(()=>E(r({$pending:h,$invalid:g,$params:r(m),$model:a,$response:y,$validator:c,$propertyPath:v,$property:$}))):E||"",$params:m,$pending:h,$invalid:g,$response:y,$unwatch:R}}function o(){}function i(e,t,r){if(r)return t?t(e()):e();try{var n=Promise.resolve(e());return t?n.then(t):n}catch(e){return Promise.reject(e)}}function c(e){const r=(a=function(){return T(),function(e,t){var r=e();return r&&r.then?r.then(t):t(r)}((function(){if(b.$rewardEarly)return N(),i(t.nextTick,o,e);var e}),(function(){return i(t.nextTick,(function(){return new Promise(e=>{if(!I.value)return e(!k.value);const r=t.watch(I,()=>{e(!k.value),r()})})}))}))},function(){for(var e=[],t=0;t<arguments.length;t++)e[t]=arguments[t];try{return Promise.resolve(a.apply(this,e))}catch(e){return Promise.reject(e)}});var a;let{validations:u,state:s,key:$,parentKey:v,childResults:d,resultsCache:f,globalConfig:p={},instance:h,externalResults:m}=e;const y=v?`${v}.${$}`:$,{rules:g,nestedValidators:R,config:E}=function(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};const r=t.unref(e),a=Object.keys(r),u={},s={},l={};return a.forEach(e=>{const t=r[e];switch(!0){case n(t.$validator):u[e]=t;break;case n(t):u[e]={$validator:t};break;case e.startsWith("$"):l[e]=t;break;default:s[e]=t}}),{rules:u,nestedValidators:s,config:l}}(u),b=Object.assign({},p,E),j=$?t.computed(()=>{const e=t.unref(s);return e?t.unref(e[$]):void 0}):s,w=Object.assign({},t.unref(m)||{}),C=t.computed(()=>{const e=t.unref(m);return $?e?t.unref(e[$]):void 0:e}),O=function(e,r,n,a,u,s,o,i,c){const $=Object.keys(e),v=a.get(u,e),d=t.ref(!1),f=t.ref(!1),p=t.ref(0);if(v){if(!v.$partial)return v;v.$unwatch(),d.value=v.$dirty.value}const h={$dirty:d,$path:u,$touch:()=>{d.value||(d.value=!0)},$reset:()=>{d.value&&(d.value=!1)},$commit:()=>{}};return $.length?($.forEach(t=>{h[t]=l(e[t],r,h.$dirty,s,o,t,n,u,c,f,p)}),h.$externalResults=t.computed(()=>i.value?[].concat(i.value).map((e,t)=>({$propertyPath:u,$property:n,$validator:"$externalResults",$uid:`${u}-externalResult-${t}`,$message:e,$params:{},$response:null,$pending:!1})):[]),h.$invalid=t.computed(()=>{const e=$.some(e=>t.unref(h[e].$invalid));return f.value=e,!!h.$externalResults.value.length||e}),h.$pending=t.computed(()=>$.some(e=>t.unref(h[e].$pending))),h.$error=t.computed(()=>!!h.$dirty.value&&(h.$pending.value||h.$invalid.value)),h.$silentErrors=t.computed(()=>$.filter(e=>t.unref(h[e].$invalid)).map(e=>{const r=h[e];return t.reactive({$propertyPath:u,$property:n,$validator:e,$uid:`${u}-${e}`,$message:r.$message,$params:r.$params,$response:r.$response,$pending:r.$pending})}).concat(h.$externalResults.value)),h.$errors=t.computed(()=>h.$dirty.value?h.$silentErrors.value:[]),h.$unwatch=()=>$.forEach(e=>{h[e].$unwatch()}),h.$commit=()=>{f.value=!0,p.value=Date.now()},a.set(u,e,h),h):(v&&a.set(u,e,h),h)}(g,j,$,f,y,b,h,C,s),_=function(e,t,r,n,a,u,s){const l=Object.keys(e);return l.length?l.reduce((l,o)=>(l[o]=c({validations:e[o],state:t,key:o,parentKey:r,resultsCache:n,globalConfig:a,instance:u,externalResults:s}),l),{}):{}}(R,j,y,f,b,h,C),{$dirty:x,$errors:P,$invalid:k,$anyDirty:L,$error:V,$pending:I,$touch:T,$reset:D,$silentErrors:A,$commit:N}=function(e,r,n){const a=t.computed(()=>[r,n].filter(e=>e).reduce((e,r)=>e.concat(Object.values(t.unref(r))),[])),u=t.computed({get:()=>e.$dirty.value||!!a.value.length&&a.value.every(e=>e.$dirty),set(t){e.$dirty.value=t}}),s=t.computed(()=>{const r=t.unref(e.$silentErrors)||[],n=a.value.filter(e=>(t.unref(e).$silentErrors||[]).length).reduce((e,t)=>e.concat(...t.$silentErrors),[]);return r.concat(n)}),l=t.computed(()=>{const r=t.unref(e.$errors)||[],n=a.value.filter(e=>(t.unref(e).$errors||[]).length).reduce((e,t)=>e.concat(...t.$errors),[]);return r.concat(n)}),o=t.computed(()=>a.value.some(e=>e.$invalid)||t.unref(e.$invalid)||!1),i=t.computed(()=>a.value.some(e=>t.unref(e.$pending))||t.unref(e.$pending)||!1),c=t.computed(()=>a.value.some(e=>e.$dirty)||a.value.some(e=>e.$anyDirty)||u.value),$=t.computed(()=>!!u.value&&(i.value||o.value)),v=()=>{e.$touch(),a.value.forEach(e=>{e.$touch()})};return a.value.length&&a.value.every(e=>e.$dirty)&&v(),{$dirty:u,$errors:l,$invalid:o,$anyDirty:c,$error:$,$pending:i,$touch:v,$reset:()=>{e.$reset(),a.value.forEach(e=>{e.$reset()})},$silentErrors:s,$commit:()=>{e.$commit(),a.value.forEach(e=>{e.$commit()})}}}(O,_,d),F=$?t.computed({get:()=>t.unref(j),set:e=>{x.value=!0;const r=t.unref(s),n=t.unref(m);n&&(n[$]=w[$]),t.isRef(r[$])?r[$].value=e:r[$]=e}}):null;return $&&b.$autoDirty&&t.watch(j,()=>{x.value||T();const e=t.unref(m);e&&(e[$]=w[$])},{flush:"sync"}),t.reactive(Object.assign({},O,{$model:F,$dirty:x,$error:V,$errors:P,$invalid:k,$anyDirty:L,$pending:I,$touch:T,$reset:D,$path:y||"__root",$silentErrors:A,$validate:r,$commit:N},d&&{$getResultsForChild:function(e){return(d.value||{})[e]},$clearExternalResults:function(){t.isRef(m)?m.value=w:0===Object.keys(w).length?Object.keys(m).forEach(e=>{delete m[e]}):Object.assign(m,w)}},_))}class ${constructor(){this.storage=new Map}set(e,t,r){this.storage.set(e,{rules:t,result:r})}checkRulesValidity(e,r,n){const a=Object.keys(n),u=Object.keys(r);if(u.length!==a.length)return!1;return!!u.every(e=>a.includes(e))&&u.every(e=>!r[e].$params||Object.keys(r[e].$params).every(a=>t.unref(n[e].$params[a])===t.unref(r[e].$params[a])))}get(e,t){const r=this.storage.get(e);if(!r)return;const{rules:n,result:a}=r,u=this.checkRulesValidity(e,t,n),s=a.$unwatch?a.$unwatch:()=>({});return u?a:{$dirty:a.$dirty,$partial:!0,$unwatch:s}}}const v={COLLECT_ALL:!0,COLLECT_NONE:!1},d=Symbol("vuelidate#injectChildResults"),f=Symbol("vuelidate#removeChildResults");function p(e){let{$scope:r,instance:n}=e;const a={},u=t.ref([]),s=t.computed(()=>u.value.reduce((e,r)=>(e[r]=t.unref(a[r]),e),{}));n.__vuelidateInjectInstances=[].concat(n.__vuelidateInjectInstances||[],(function(e,t){let{$registerAs:n,$scope:s,$stopPropagation:l}=t;l||r===v.COLLECT_NONE||s===v.COLLECT_NONE||r!==v.COLLECT_ALL&&r!==s||(a[n]=e,u.value.push(n))})),n.__vuelidateRemoveInstances=[].concat(n.__vuelidateRemoveInstances||[],(function(e){u.value=u.value.filter(t=>t!==e),delete a[e]}));const l=t.inject(d,[]);t.provide(d,n.__vuelidateInjectInstances);const o=t.inject(f,[]);return t.provide(f,n.__vuelidateRemoveInstances),{childResults:s,sendValidationResultsToParent:l,removeValidationResultsFromParent:o}}function h(e){return new Proxy(e,{get:(e,r)=>"object"==typeof e[r]?h(e[r]):t.computed(()=>e[r])})}function m(e,r){let u=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};1===arguments.length&&(u=e,e=void 0,r=void 0);let{$registerAs:s,$scope:l=v.COLLECT_ALL,$stopPropagation:o,$externalResults:i,currentVueInstance:d}=u;const f=d||t.getCurrentInstance(),m=f?f.proxy.$options:{};if(!s&&f){const e=f.uid||f._uid;s="_vuelidate_"+e}const y=t.ref({}),g=new $,{childResults:R,sendValidationResultsToParent:E,removeValidationResultsFromParent:b}=f?p({$scope:l,instance:f}):{childResults:t.ref({})};if(!e&&m.validations){const e=m.validations;r=t.ref({}),t.onBeforeMount(()=>{r.value=f.proxy,t.watch(()=>n(e)?e.call(r.value,new h(r.value)):e,e=>{y.value=c({validations:e,state:r,childResults:R,resultsCache:g,globalConfig:u,instance:f.proxy,externalResults:i||f.proxy.vuelidateExternalResults})},{immediate:!0})}),u=m.validationsConfig||u}else{const n=t.isRef(e)||a(e)?e:t.reactive(e||{});t.watch(n,e=>{y.value=c({validations:e,state:r,childResults:R,resultsCache:g,globalConfig:u,instance:f?f.proxy:{},externalResults:i})},{immediate:!0})}return f&&(E.forEach(e=>e(y,{$registerAs:s,$scope:l,$stopPropagation:o})),t.onBeforeUnmount(()=>b.forEach(e=>e(s)))),t.computed(()=>Object.assign({},t.unref(y.value),R.value))}return e.CollectFlag=v,e.default=m,e.useVuelidate=m,Object.defineProperty(e,"__esModule",{value:!0}),e}({},VueDemi);
//# sourceMappingURL=index.iife.min.js.map
