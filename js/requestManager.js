class RequestManager{
  /**
   *  GETパラメーター取得
   *
   * @returns {Object} arg
   *  let query_st = getParam();
   *  query_st.queryname
   */
  getParam() {
    let arg = new Object();
    //urlクエリーストリングの分解
    let url = location.search.substring(1).split("&");
    for (let i = 0; url[i]; i++) {
      let k = url[i].split("=");
      arg[k[0]] = k[1];
    }
    return arg;
  }
}