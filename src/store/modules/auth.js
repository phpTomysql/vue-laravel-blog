/*
|--------------------------------------------------------------------------
| Mutation Types
|--------------------------------------------------------------------------
*/
export const SET_USER = 'SET_USER';
export const UNSET_USER = 'UNSET_USER';
export const SET_TOGGLE = 'SET_TOGGLE';
//export const SET_SUBSCRIPTION_STATUS = 'SET_SUBSCRIPTION_STATUS';
//export const SET_START_SIGNUP = 'SET_START_SIGNUP';
//export const SET_SIGNUP_STEPS = 'SET_SIGNUP_STEPS';
//export const SET_INR_PAGE_CLASS = 'SET_INR_PAGE_CLASS';

/*
|--------------------------------------------------------------------------
| Initial State
|--------------------------------------------------------------------------
*/
const initialState = {
	_name: null,
	_email: null,
	_id:null,
	isToggle: false
};

/*
|--------------------------------------------------------------------------
| Mutations
|--------------------------------------------------------------------------
*/
const mutations = {
	[SET_USER](state, payload) {
		//console.log( payload )
		state._name = payload.name;
		state._email = payload.email;
		state._id = payload.id;
	},
	[UNSET_USER](state, payload) {
		state._name = null;
		state._email = null;
		state._id = null;
	},
	[SET_TOGGLE](state, payload) {
		state.isToggle = payload;
		
	}
}; 

/*
|--------------------------------------------------------------------------
| Actions
|--------------------------------------------------------------------------
*/
const actions = {
	setAuthUser: (context, user) => {
		context.commit(SET_USER, user)
	},
	unsetAuthUser: (context) => {
		context.commit(UNSET_USER);
	},
	toggleMenuAction (context, payload) {
		context.commit(SET_TOGGLE, payload)
	}
};

/*
|--------------------------------------------------------------------------
| Getters
|--------------------------------------------------------------------------
*/
const getters = {
	isLoggedIn: (state) => {
		return !!(state._name && state._email);
	},
	userName: (state) => {
		return state._name;
	},
	userEmail:(state)=>{
		return state._email;
	},
	userId:(state)=>{
		return state._id;
	},
	toggleMenuGetter (state) {
		return state.isToggle
    }
};

/*
|--------------------------------------------------------------------------
| Export the module
|--------------------------------------------------------------------------
*/
export default {
	state: initialState,
	mutations,
	actions,
	getters
}