## 🔖 [0.0.1] 
##### 📖🏰 Story: Manage coupons

### Added

Install Vue.js 2.0:
- Added Vue.js to project.

Install Bootstrap Vue.

views/login
- Created login blade file to screen login.

js/adm/CouponComponent:
- Created component to adm coupon.

js/utils/LoadComponent:
- Created component to load async methods.

js/utils/NavBarComponent:
- Created component to nav bar page.

js/adm/CouponComponent:
- Added datatable component.

commons/commons.js
- Added method to request API with AXIOS.
---

## 🔖 [0.0.2] 

### Added
.env:
- Variables API_SECRETS and LOGIN_BASE_URI connection URL and Token key

Middleware:
- Middleware CheckUserSession added to verify session user logged.

routes/web.php:
- Middleware group user.session protect added 
- Routes '/login-submit', '/adm', '/' and '/logout' added.

Login/LoginController:
- Method index added to render view blade.
- Method login added.
- method construct added.
- method logout added.

Adm/CouponController:
- Method index added to render view blade.

js/app.js
- added imports BootstrapVue, IconsPlugin and Swal.
- added import common function.
- Added 'coupon-component', 'load-component' and 'navbar-component' components Vue.
- Added return window.toast.




