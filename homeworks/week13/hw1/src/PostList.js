/*
    處理文章列表
    p.s. 還未做分頁功能
*/

import React from 'react';
import { withRouter } from 'react-router-dom';
import axios from 'axios';


// 單一列表
class List extends React.Component {

    handelClick() {
        this.props.handelClick(this.props.post.id)
    }

    render() {
        const {post} = this.props;

        return (
            <li className="list-group-item border-top-0 pl-0 mb-5">
                <h5 className="post-list-title" onClick={()=>this.handelClick()}>{post.title}</h5>
                <div className="post-list-infomation text-secondary">
                    <span className="post-list-author">
                        <i className="fas fa-user mr-2"></i>
                        {post.author}
                    </span>
                </div>
            </li>
        );
    }
}

// 文章列表頁
class PostList extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            posts: [],
        }
    }

    componentDidMount() {
        // ajax 抓資料
        axios.get('http://45.55.26.18:3310/posts?_sort=id&_order=desc')
            .then((res)=>{
                this.setState({
                    posts: res.data,
                });
            })
            .catch((err) => {
                console.log(err);
            })
    }

    handelClick(id) {
        const {history} = this.props;
        history.push('/posts/' + id);
    }

    render() {
        const {posts} = this.state;

        return (
            <div>
                <header className="content__header">
                    <h2 className="content__title">文章列表</h2>
                </header>
                <div className="content__body">
                    <div className="card border-0">
                        <ul className="list-group list-group-flush">
                            {posts.map((item) => 
                                <List
                                    key={item.id}
                                    post={item}
                                    handelClick={(id) =>this.handelClick(id)}
                                />
                            )}
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}

export default withRouter(PostList);
