/*
    處理首頁
    - 顯示最新 10 篇
*/

import React from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

class Home extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            posts: [],
        }
    }

    componentDidMount() {
        // ajax 取文章，依 id 反序，10 篇
        axios.get('http://45.55.26.18:3310/posts?_sort=id&_order=desc&_limit=10')
            .then((res) => {
                this.setState({
                    posts: res.data,
                });
            })
            .catch((err) => {
                console.log(err);
            })
    }

    render() {
        const {posts} = this.state;
        //console.log(posts)
        
        return (
            <div>
                <div className="my-3">
                    {posts.map((item) => 
                        <div className="card border-0 mb-5" key={item.id}>
                            <div className="card-body border-bottom">
                                <h2 className="card-title mb-3">
                                    <Link to={"/posts/" + item.id } className="card-link text-dark">{item.title}</Link>
                                </h2>
                                <h6 className="card-subtitle mb-2 text-muted">
                                    <i className="fas fa-user mr-2"></i>
                                    {item.author}
                                </h6>
                                <p className="card-text mt-3 text-truncate">{item.body}</p>
                                <Link to={"/posts/" + item.id } className="card-link text-secondary">繼續閱讀</Link>
                            </div>
                        </div>
                    )}
                </div>
            </div>
        );
        
    }
}

export default Home;