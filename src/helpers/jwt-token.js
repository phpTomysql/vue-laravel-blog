export default {
	setToken(token) {
		window.localStorage.setItem('app_token', token);
	},
	getToken() {
		return window.localStorage.getItem('app_token');
	},
	removeToken() {
		window.localStorage.removeItem('app_token');
	}
}