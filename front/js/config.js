
var projectName = 'ClubPlus';

var swiper = {
	
	width: '100%',
	height: '400px',
	
	arrow: 'none',
	
	anim: 'default',
	
	interval: 2000,
	
	indicator: 'outside'
}


var centerMenu = [{
	name: 'My Info',
	url: '../' + localStorage.getItem('userTable') + '/center.html'
}, 
{
	name: 'Favorites',
	url: '../storeup/list.html'
}
]


var indexNav = [

{
	name: 'Club Info',
	url: './pages/ClubInfo/list.html'
}, 
{
	name: 'Club Event',
	url: './pages/Event/list.html'
}, 
{
	name: 'Album',
	url: './pages/Album/list.html'
}, 

{
	name: 'Announcement',
	url: './pages/news/list.html'
},
]

var adminurl =  "/ClubPlus/admin/dist/index.html";

var cartFlag = false

var chatFlag = false




var menu = [{"backMenu":[{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"Club","menuJump":"list","tableName":"Club"}],"menu":"Club Management"},{"child":[{"buttons":["View","Update","Delete"],"menu":"Club Info","menuJump":"list","tableName":"ClubInfo"}],"menu":"Club Info Management"},{"child":[{"buttons":["View","Update","Delete"],"menu":"Club Event","menuJump":"list","tableName":"Event"}],"menu":"Club Event Management"},{"child":[{"buttons":["View","Update","Delete"],"menu":"Club Album","menuJump":"list","tableName":"Album"}],"menu":"Club Album Management"},{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"User","menuJump":"list","tableName":"OrdinaryUser"}],"menu":"User Management"},{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"Announcement","tableName":"news"},{"buttons":["View","Update"],"menu":"System Background","tableName":"config"}],"menu":"System Management"}],"frontMenu":[{"child":[{"buttons":["View","Apply"],"menu":"Club Info List","menuJump":"list","tableName":"ClubInfo"}],"menu":"Club Info Module"},{"child":[{"buttons":["View","Apply"],"menu":"Club Event List","menuJump":"list","tableName":"Event"}],"menu":"Club Event Module"},{"child":[{"buttons":["View"],"menu":"Club Album List","menuJump":"list","tableName":"Album"}],"menu":"Club Album Module"}],"hasBackLogin":"Yes","hasBackRegister":"No","hasFrontLogin":"No","hasFrontRegister":"No","roleName":"Admin","tableName":"users"},{"backMenu":[{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"Club Info","menuJump":"list","tableName":"ClubInfo"}],"menu":"Club Info Management"},{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"Club Event","menuJump":"list","tableName":"Event"}],"menu":"Club Event Management"},{"child":[{"buttons":["Add","View","Update","Delete"],"menu":"Club Album","menuJump":"list","tableName":"Album"}],"menu":"Club Album Management"},{"child":[{"buttons":["View","Delete","Approval"],"menu":"View Application","menuJump":"list","tableName":"EventApplication"}],"menu":"Event Application"},{"child":[{"buttons":["View","Approval","Delete"],"menu":"View Application","menuJump":"list","tableName":"ClubApplication"}],"menu":"Club Application"}],"frontMenu":[{"child":[{"buttons":["View","Apply"],"menu":"Club Info List","menuJump":"list","tableName":"ClubInfo"}],"menu":"Club Info Module"},{"child":[{"buttons":["View","Apply"],"menu":"Club Event List","menuJump":"list","tableName":"Event"}],"menu":"Club Event Module"},{"child":[{"buttons":["View"],"menu":"Club Album List","menuJump":"list","tableName":"Album"}],"menu":"Club Album Module"}],"hasBackLogin":"Yes","hasBackRegister":"Yes","hasFrontLogin":"No","hasFrontRegister":"No","roleName":"Club","tableName":"Club"},{"backMenu":[{"child":[{"buttons":["View"],"menu":"View Application","menuJump":"list","tableName":"EventApplication"}],"menu":"Event Application"},{"child":[{"buttons":["View"],"menu":"View Application","menuJump":"list","tableName":"ClubApplication"}],"menu":"Club Application"},{"child":[{"buttons":["View","Delete"],"menu":"Manage My Favorite","tableName":"storeup"}],"menu":"My Favorite"}],"frontMenu":[{"child":[{"buttons":["View","Apply"],"menu":"Club Info List","menuJump":"list","tableName":"ClubInfo"}],"menu":"Club Info Module"},{"child":[{"buttons":["View","Apply"],"menu":"Club Event List","menuJump":"list","tableName":"Event"}],"menu":"Club Event Module"},{"child":[{"buttons":["View"],"menu":"Club Album List","menuJump":"list","tableName":"Album"}],"menu":"Club Album Module"}],"hasBackLogin":"No","hasBackRegister":"No","hasFrontLogin":"Yes","hasFrontRegister":"Yes","roleName":"User","tableName":"OrdinaryUser"}]



var isAuth = function (tableName,key) {
    let role = localStorage.getItem("userTable");
    let menus = menu;
    for(let i=0;i<menus.length;i++){
        if(menus[i].tableName==role){
            for(let j=0;j<menus[i].backMenu.length;j++){
                for(let k=0;k<menus[i].backMenu[j].child.length;k++){
                    if(tableName==menus[i].backMenu[j].child[k].tableName){
                        let buttons = menus[i].backMenu[j].child[k].buttons.join(',');
                        return buttons.indexOf(key) !== -1 || false
                    }
                }
            }
        }
    }
    return false;
}

var isFrontAuth = function (tableName,key) {
    let role = localStorage.getItem("userTable");
    let menus = menu;
    for(let i=0;i<menus.length;i++){
        if(menus[i].tableName==role){
            for(let j=0;j<menus[i].frontMenu.length;j++){
                for(let k=0;k<menus[i].frontMenu[j].child.length;k++){
                    if(tableName==menus[i].frontMenu[j].child[k].tableName){
                        let buttons = menus[i].frontMenu[j].child[k].buttons.join(',');
                        return buttons.indexOf(key) !== -1 || false
                    }
                }
            }
        }
    }
    return false;
}
