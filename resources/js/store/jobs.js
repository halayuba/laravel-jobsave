import axios from "axios";
import baseUrl from "../baseUrl";
import moment from "moment";

export default {
    namespaced: true,
/*=====================================
  ||||| STATE |||||
  =====================================*/
    state: {
        submissions: [],
        upcomingInterviews: '',
        totalSubmissionsThisWeek: '',
        submissionsHaveInterviews: '',
        completedInterviews: '',
        filteredSubmissions: '',
        interviews: []
    },
/*=====================================
  ||||| GETTERS |||||
  =====================================*/
    getters: {
        submissions(state) {
            return state.submissions
        },
        upcomingInterviews(state) {
            return state.upcomingInterviews
        },
        totalSubmissionsThisWeek(state) {
            return state.totalSubmissionsThisWeek
        },
        submissionsHaveInterviews(state) {
            return state.submissionsHaveInterviews
        },
        completedInterviews(state) {
            return state.completedInterviews
        },
        filteredSubmissions(state) {
            return state.filteredSubmissions
        },
        interviews(state) {
            return state.interviews
        },
    },
/*=====================================
  ||||| MUTATIONS |||||
  =====================================*/
    mutations: {
        /* == SET VALUES == */
        SET_SUBMISSIONS(state, value) {
            state.submissions = value
        },
        SET_UPCOMING_INTERVIEWS(state, value) {
            state.upcomingInterviews = value.upcomingInterviews
        },
        SET_TOTAL_SUBMISSIONS_THIS_WEEK(state, value) {
            state.totalSubmissionsThisWeek = value.totalSubmissionsThisWeek
        },
        SET_SUBMISSIONS_HAVE_INTERVIEWS(state, value) {
            state.submissionsHaveInterviews = value.submissionsHaveInterviews
        },
        SET_COMPLETED_INTERVIEWS(state, value) {
            state.completedInterviews = value.completedInterviews
        },
        SET_FILTERED_SUBMISSIONS(state, value) {
            state.filteredSubmissions = value.filteredSubmissions
        },
        SET_INTERVIEWS(state, value) {
            state.interviews = value
        },

        /* == STORE == */
        STORE_SUBMISSION(state, value) {
          /* == ALTHOUGH WORKS BUT THERE WILL BE CASES WHERE THIS WONT WORK => WHEN DB RECORDS GET DELETED THE SEQUENCE WILL END UP BEING OFF == */
          /* == SO IT IS BETTER TO FETCH DIRECTLY FROM THE DB == */
          /* == THIS IS A DEMO PROJECT (NOT A PRODUCTION-LEVEL) SO THIS WILL JUST WORK FOR NOW == */
          let idValue = state.submissions[0].id // SINCE THE ORDER IS DESCENDING THE [0] IS THE LAST RECORD
          let nextId = Number(idValue) + 1 // FIND THE ID VALUE OF THE LAST RECORD
          let item = {
            id: nextId,
            company: value.company,
            location: value.location,
            position: value.position,
            note: value.note,
            url: value.url,
            status: "No Feedback",
            created_at: new Date()
          }
          state.submissions.unshift(item)
        },

        /* == UPDATE == */
        UPDATE_SUBMISSION(state, { submissionId, payload }) {
          // console.log(payload)
          // console.log(submissionId)
            let submissionIndex = state.submissions.findIndex(item => item.id === submissionId)
            state.submissions[submissionIndex] = payload.payload
        },
        UPDATE_UNSUCCESSFUL(state, submissionId) {
            let submissionIndex = state.submissions.findIndex(
                item => item.id === submissionId
            );
            state.submissions[submissionIndex].status = 'Unsuccessful'
        },
        UPDATE_INTERVIEW_COMPLETION(state, interviewId){
          state.interviews.map(interview => {
            if( interview.id === interviewId ){
              interview.status = 'Completed'
            }
          })
        },

        /* == DELETE == */
        DELETE_SUBMISSION(state, submissionId) {
            let submissionIndex = state.submissions.findIndex(
                item => item.id === submissionId
            );
            state.submissions.splice(submissionIndex, 1);
        },
        DELETE_INTERVIEW(state, interviewId) {
            let key = state.interviews.findIndex(
                item => item.id === interviewId
            );
            state.interviews.splice(key, 1);
        }
    },
/*=====================================
  ||||| ACTIONS |||||
  =====================================*/
    actions: {
        /* == ALL JOB SUBMISSIONS == */
        async getJobSubmissions({ commit }) {
            try {
                let response = await axios.get(baseUrl.jobSubmissionsApiUrl);
                commit("SET_SUBMISSIONS", response.data.data);
                commit("SET_UPCOMING_INTERVIEWS", response.data.count);
                commit("SET_TOTAL_SUBMISSIONS_THIS_WEEK", response.data.count);
                commit("SET_SUBMISSIONS_HAVE_INTERVIEWS", response.data.count);
                commit("SET_COMPLETED_INTERVIEWS", response.data.count);
                commit("SET_FILTERED_SUBMISSIONS", response.data.count);
                return Promise.resolve(response.data.data);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == ALL JOB INTERVIEWS == */
        async getJobInterviews({ commit }) {
            try {
                let response = await axios.get(baseUrl.jobInterviewsApiUrl);
                commit("SET_INTERVIEWS", response.data.data);
                return Promise.resolve(response.data.data);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == STORE A NEW JOB SUBMISSION == */
        async storeJobSubmission({ commit, dispatch }, { payload }) {
            try {
                let response = await axios.post(baseUrl.jobSubmissionsApiUrl, payload);
                if(response.data.status === 409){
                  return Promise.resolve(response.data)
                } else {
                  dispatch('getJobSubmissions')
                  return Promise.resolve(response);
                }
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == STORE DETAILS ABOUT A NEW JOB INTERVIEW == */
        async storeInterviewDetail({ commit, dispatch }, { submissionId, payload }) {
            try {
                let response = await axios.post(`${baseUrl.jobSubmissionsApiUrl}/${submissionId}/interview`, payload);
                commit("SET_SUBMISSIONS", response.data.data);
                return Promise.resolve(response);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == UPDATE A JOB SUBMISSION == */
        async updateJobSubmission({ commit, dispatch }, { submissionId, payload }) {
            try {
                let response = await axios.put(`${baseUrl.jobSubmissionsApiUrl}/${submissionId}`, payload);
                if(response.data.status === 409){
                  return Promise.resolve(response.data)
                } else {
                  dispatch('getJobSubmissions')
                  // commit("UPDATE_SUBMISSION", {submissionId, payload});
                  return Promise.resolve(response);
                }
                // commit("SET_SUBMISSIONS", response.data.data); /* == COULD BE USED IF RETURNING EVERYTHING FROM THE CONTROLLER == */
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == UPDATE A JOB APPLICATION AS UNSUCCESSFUL == */
        async updateNotSuccessful({ commit }, submissionId) {
            try {
                let response = await axios.put(`${baseUrl.jobSubmissionsApiUrl}/${submissionId}/unsuccessful`);
                commit("UPDATE_UNSUCCESSFUL", submissionId);
                return Promise.resolve(response.data.data);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == UPDATE THE DETAILS OF A JOB INTERVIEW == */
        async updateJobInterview({ commit, dispatch }, { interviewId, payload }) {
            try {
                let response = await axios.put(`${baseUrl.jobInterviewsApiUrl}/${interviewId}`, payload);
                dispatch('getJobInterviews')
                // commit("UPDATE_INTERVIEW", interviewId);
                return Promise.resolve(response.data.data);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == UPDATE THE STATUS OF A JOB INTERVIEW TO COMPLETED == */
        async updateJobInterviewToCompleted({ commit }, interviewId) {
          try {
            let response = await axios.put(
              `${baseUrl.jobInterviewsApiUrl}/${interviewId}/update-completed`);
            commit("UPDATE_INTERVIEW_COMPLETION", interviewId);
            return Promise.resolve(response.data.data);
          } catch (error) {
              return Promise.reject(error);
          }
        },
        /* == REMOVE A JOB SUBMISSION == */
        async removeJobSubmission({ commit }, submissionId) {
            try {
                let response = await axios.delete(`${baseUrl.jobSubmissionsApiUrl}/${submissionId}`);
                commit("DELETE_SUBMISSION", submissionId);
                return Promise.resolve(response);
            } catch (error) {
                return Promise.reject(error);
            }
        },
        /* == REMOVE A JOB SUBMISSION == */
        async removeJobInterview({ commit }, interviewId) {
            try {
                let response = await axios.delete(`${baseUrl.jobInterviewsApiUrl}/${interviewId}`);
                commit("DELETE_INTERVIEW", interviewId);
                return Promise.resolve(response);
            } catch (error) {
                return Promise.reject(error);
            }
        }
    }
};
