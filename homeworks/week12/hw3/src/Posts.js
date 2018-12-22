/*
    處理文章頁面
*/

import React from 'react';
import axios from 'axios';

// 單篇文章
class Post extends React.Component {
    backToPostList() {
        this.props.clickBtn()
    }

    render() {
        const {post} = this.props;

        return (
            <div>
                <button
                    className="btn btn-outline-info my-3"
                    onClick={() => this.backToPostList()}
                >back</button>
                <p>{'#' + post.id}</p>
                <h2>{post.title}</h2>
                <p>{post.body}</p>
            </div>
        )
    }
}

// 單一列表
class List extends React.Component {

    handleGoToPost() {
        this.props.onClick(this.props.post)
    }

    render() {
        const {post} = this.props;

        return (
            <li
                className="list-group-item"
                onClick={() => this.handleGoToPost()}
            >
                {'#' + post.id}<br />
                {post.title}
            </li>     
        );
    }
}

// 文章列表頁
class Posts extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            posts: [],
            getPost: null,
        }
    }

    componentDidMount() {
        // ajax 抓資料
        axios.get('https://jsonplaceholder.typicode.com/posts')
            .then((res)=>{
                this.setState({
                    posts: res.data,
                });
            })
            .catch((err) => {
                console.log(err);
            })
    }

    // 取得點選的文章
    getPost (post) {
        this.setState({
            getPost: post,
        });
    }

    // 回到文章列表
    backToPostList () {
        this.setState({
            getPost: null,
        });
    }


    render() {
        const {posts, getPost} = this.state;

        return (
            <div>
                {
                    getPost !== null && 
                    <Post
                        post={getPost}
                        clickBtn={() => this.backToPostList()}
                    />
                }
                
                {
                    getPost === null && 
                    <div>
                        <div className="my-3">
                            <h2>文章列表</h2>
                        </div>
                        <div className="card">
                            <ul className="list-group list-group-flush">
                                {posts.map((item) => 
                                    <List
                                        key={item.id}
                                        post={item}
                                        onClick={(i) => this.getPost(i)}
                                    />
                                )}
                            </ul>
                        </div>
                    </div>
                }
            </div>
        )
    }
}

export default Posts;
