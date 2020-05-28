const apiDomain = process.env.VUE_APP_API_DOMAIN;
export const siteName = process.env.VUE_APP_NAME

export const API = {
	login: apiDomain + 'user/login',
	signup: apiDomain + 'user/register',
	currentUser: apiDomain + 'user/me',
	logout:apiDomain + 'user/logout',
	posts:apiDomain + 'post/all',
	category:apiDomain + 'categories',
	addPost:apiDomain+ 'post/add',
	post:apiDomain+ 'post',
	comment:apiDomain+ 'post/comment/add'
};