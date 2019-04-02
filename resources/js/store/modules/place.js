import { make } from 'vuex-pathify'

let initial_state = {
    init: true,
    overview: {},

    selected: {},
    hover: {},
    booking: {}
}

export const mutations = make.mutations(initial_state)
export const actions = make.actions(initial_state)
export const getters = make.getters(initial_state)
