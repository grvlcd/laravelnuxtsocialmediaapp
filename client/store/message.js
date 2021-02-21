export const state = () => ({
  threads: []
});

export const getters = {
  getThreads: state => {
    return state.threads;
  }
};

export const mutations = {
  SET_THREADS(state, threads) {
    state.threads = threads;
  }
};

export const actions = {};
