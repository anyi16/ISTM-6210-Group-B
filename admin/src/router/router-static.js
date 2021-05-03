import Vue from 'vue';
import VueRouter from 'vue-router'
Vue.use(VueRouter);
import Index from '@/views/index'
import Home from '@/views/home'
import Login from '@/views/login'
import NotFound from '@/views/404'
import UpdatePassword from '@/views/update-password'
import pay from '@/views/pay'
import register from '@/views/register'
import center from '@/views/center'
    import news from '@/views/modules/news/list'
    import Album from '@/views/modules/Album/list'
    import Club from '@/views/modules/Club/list'
    import Event from '@/views/modules/Event/list'
    import OrdinaryUser from '@/views/modules/OrdinaryUser/list'
    import EventApplication from '@/views/modules/EventApplication/list'
    import ClubInfo from '@/views/modules/ClubInfo/list'
    import storeup from '@/views/modules/storeup/list'
    import config from '@/views/modules/config/list'
    import ClubApplication from '@/views/modules/ClubApplication/list'


const routes = [{
    path: '/index',
    name: 'Home',
    component: Index,
    children: [{
      // 
      path: '/',
      name: 'Home',
      component: Home,
      meta: {icon:'', title:'center'}
    }, {
      path: '/updatePassword',
      name: 'Change Password',
      component: UpdatePassword,
      meta: {icon:'', title:'updatePassword'}
    }, {
      path: '/pay',
      name: 'pay',
      component: pay,
      meta: {icon:'', title:'pay'}
    }, {
      path: '/center',
      name: 'My Info',
      component: center,
      meta: {icon:'', title:'center'}
    }
          ,{
	path: '/news',
        name: 'Announcement',
        component: news
      }
          ,{
	path: '/Album',
        name: 'Album',
        component: Album
      }
          ,{
	path: '/Club',
        name: 'Club',
        component: Club
      }
          ,{
	path: '/Event',
        name: 'Event',
        component: Event
      }
          ,{
	path: '/OrdinaryUser',
        name: 'User',
        component: OrdinaryUser
      }
          ,{
	path: '/EventApplication',
        name: 'Apply',
        component: EventApplication
      }
          ,{
	path: '/ClubInfo',
        name: 'Club Info',
        component: ClubInfo
      }
          ,{
	path: '/storeup',
        name: 'My Favorite Management',
        component: storeup
      }
          ,{
	path: '/config',
        name: 'Background Management',
        component: config
      }
          ,{
	path: '/ClubApplication',
        name: 'Apply',
        component: ClubApplication
      }
        ]
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {icon:'', title:'login'}
  },
  {
    path: '/register',
    name: 'register',
    component: register,
    meta: {icon:'', title:'register'}
  },
  {
    path: '/',
    name: 'Home',
    redirect: '/index'
  }, 
  {
    path: '*',
    component: NotFound
  }
]
const router = new VueRouter({
  mode: 'hash',
  routes 
})

export default router;
