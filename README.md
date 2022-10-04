# Blog

[![laravel](https://img.shields.io/badge/Laravel-v9.2-ff1e12?logo=laravel)](https://laravel.com/docs/9.x)
[![vue](https://img.shields.io/badge/Vue.js-v2.6.14-33b378?logo=vuedotjs)](https://v2.vuejs.org/)
[![vuetify](https://img.shields.io/badge/Vuex-v3.6.2-33b378)](https://v3.vuex.vuejs.org/)
[![vuetify](https://img.shields.io/badge/Bootstrap-v5.1.3-6a2ff9?logo=bootstrap)](https://getbootstrap.com/docs/5.1/getting-started/introduction/)

## About project

A solution where anyone can share their ideas, read the posts of other authors and comment on what they want, whether the post itself or the comments of other users.

Without registration one can only read the posts, comments are not visible to guests.

To post and register users verification was introduced both at the web level and at the level of requests.

The visibility of comments and the ability to work with them is implemented on the basis of policies. 

The project has three resource models (user, post, comment) with polymorphic relationships.
