const todos = (state = initialState, action) => {
    switch (action.type) {
      case ActionTypes.FETCH_COMPLETED_SUCCESS:
        let newTodos = {};
        action.completedIds.forEach((id) => {
            newTodos[id] = {
                ...state.todos[id],
                completed: true
            } 
          })
        return {
          ...state,
          todos: {
               ...state.todos,
               ...newTodos
          }
        }
      default:
        return state
    }
  };


  