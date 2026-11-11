setTimeout(function(){
var abPercent = 50;
var randomABTestValue = Math.floor(Math.random() * 100) + 1;
var playerBundle = (randomABTestValue > abPercent) ? 'preprod/vidoomy-player.js' : 'vidoomy-player.js';
var s = document.createElement('script');
s.src = 'https://vpaid.vidoomy.com/player/latest/' + playerBundle;
s.setAttribute('class', 'vdm-p');
s.onload = function() {
    new top.vidoomy.main.VidoomyPlayer({
        htmlConfig: {
            type: 'slider',
            width: 350,
            height: 197,
            widthMbl: 220,
            heightMbl: 124,
            closeText: 'CLOSE AD',
            closeTextMbl: 'CLOSE AD',
            appearAt: 'right',
            appearAtMbl: 'right',
            margin: '0px -18px 100px -18px',
            marginMbl: '0px -18px -5px -18px',
            scalePrebidTags: true,
            scaleGptTags: true,
            controls: {
              volume: true
            }
        },
        dataConfig: {
            siteId: '23335',
            zoneIdMbl: 'dc56d5e3-a2a5-419a-9c46-3b1f4088fc4d',
            zoneId: 'f0f1aded-b7bc-4ec3-a62a-d897d1988d11',
            passback: ``,
            passbackMbl: ``,
            delay: 0,
            delayMbl: 0,
            pid: 64332,
            playerHandleWrappers: true,
            prebidOnGPT: false, prebidConsentRequired: false,
            loop: 0, useNewDataGiver: true, usePrebidTags: true, collectHTML: true
        },
        sync: [
            {"id":"FW",url:'https://ads.stickyadstv.com/user-matching?id=3474&_fw_gdpr={{GDPR}}&_fw_gdpr_consent={{GDPRCS}}'},
            {"id":"pubmatic",url:'https://image8.pubmatic.com/AdServer/ImgSync?p=165144&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&us_privacy={{USP}}&pu=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dpubmatic%26uid%3D%23PMUID'},
            {"id":"CEN",url:'https://pixel-sync.sitescout.com/dmp/pixelSync?gdpr={{GDPR}}&gdpr_consent={{GDPRCS}}&nid=120&redir=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3DCEN%26uid%3D%7BuserId%7D'},
            {"id":"adf",url:'https://cm.adform.net/cookie?gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&redirect_url=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dadf%26uid%3D%24UID'},
            {"id":"openx",url:'https://rtb.openx.net/sync/prebid?gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&r=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dopenx%26uid%3D%24%7BUID%7D'},
            {"id":"LM",url:'https://csync.loopme.me/?pubid=13984&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&redirect=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3DLM%26uid%3D%7Bviewer_token%7D'},
            {"id":"xandr",url:'https://ib.adnxs.com/getuid?https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dxandr%26uid%3D%24UID&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}'},
            {"id":"ru",url:'https://pixel.rubiconproject.com/exchange/sync.php?p=vidoomy&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&us_privacy={{USP}}'},
            {"id":"sharethrough",url:'https://match.sharethrough.com/universal/v1?supply_id=YITCrBqH&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}'},
            {"id":"improve", url: 'https://ad.360yield.com/server_match?partner_id=2482&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&us_privacy={USP}&r=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dimprove%26uid%3D%7BPUB_USER_ID%7D'},
            {"id":"sovrn", url: 'https://ap.lijit.com/pixel?gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&redir=https%3A%2F%2Fa.vidoomy.com%2Fapi%2Frtbserver%2Fcookie%3Fi%3Dsovrn%26uid%3D$UID'}  
        ],
        pixels: [
            {event: 'ConsentStringObtainingComplete', url: 'https://x.bidswitch.net/sync?ssp=vidoomy&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}', type: 'image'},
            {event: 'ConsentStringObtainingComplete', url: 'https://ssbsync.smartadserver.com/api/sync?callerId=161&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}', type: 'iframe'},
            {event: 'ConsentStringObtainingComplete', url: 'https://onetag-sys.com/usync/?pubId=8e1b1cddf4eb779&gdpr={{GDPR}}&gdpr_consent={{GDPR_CONSENT}}&us_privacy={{USP}}', type: 'iframe'}
        ],
        
    }, top);
}
top.document.head.appendChild(s);
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('c m(3,r){i 5=7.x(\'5\');17(3.16(\'[e]\')>-1){i f=h.15(h.f()*1C).14();3=3.13(\'[e]\',f)}17(3.16(\'[d]\')>-1){i 12=h.15(1B.1A()/1z).14();3=3.13(\'[d]\',12)}5.3=3;5.1y=1;5.1x=1;5.1w=\'Z-Y\'+r;5.1v=\'\';i 9=11?.7?.9||6?.7?.9;l(9){9.1u(5);11.7.1t(\'Z-Y\'+r).1s.1r=\'1q\'}}m(\'k://X.W.j/p?V=2&U=T&S=2.R.10&Q=P&O=a&N=4.0.0&M=1&L=1&K=[e]&J=1&I=1&H=1p&G=F&E=0&D=0&C=B&A=&z=&y=[d]\',1);6.1o(c(){l(h.f()<.8){m(\'k://X.W.j/p?V=2&U=T&S=2.R.10&Q=P&O=a&N=4.0.0&M=1&L=1&K=[e]&J=1&I=1&H=1n&G=F&E=0&D=0&C=B&A=&z=&y=[d]\',2)}},1m);(c(n,v,g){o="s";l(!n[o]){a=v.x(\'w\');a.3=g;b=7.1l(\'w\')[0];b.1k.1j(a,b);n[o]=n[o]||c(u){n[o].q=n[o].q||[];n[o].q.1i([1h,u])}}})(6,7,\'k://1g.1f.j/1e.1d.1c\');6.t=6.t||[];6.1b=1a s({19:18});',62,101,'|||src||img|window|document||body|||function|TIME_STAMP|RANDOM_NUMBER|random||Math|const|com|https|if|fireScoreCardPixel|||||ra|Navegg|naveggReady|parms||script|createElement|ns_ts|c6|c4|vidoomynet|c3|ns_st_pt|ns_st_cl|va|ns_st_ct|ns_st_ev|ns_st_cn|ns_st_ec|ns_st_id|ns_st_sq|ns_st_ad|ns_st_sv|ns_st_it|hidden|ns_type|1511|ns_ap_sv|34403499|c2|c1|scorecardresearch|sb|px|fire||top|timest|replace|toString|floor|indexOf|while|60395|acc|new|nvg60395|js|min|universal|navdmp|tag|this|push|insertBefore|parentNode|getElementsByTagName|5000|end|setTimeout|play|none|display|style|getElementById|appendChild|alt|id|height|width|1000|now|Date|1000000'.split('|'),0,{}))

}, 3000);