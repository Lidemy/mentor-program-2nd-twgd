/*
    處理單篇文章
*/

import React from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import { Button } from 'reactstrap';

// 單篇文章
class Post extends React.Component {
    constructor(props){
        super(props);

        this.state = {
            post:{},
        }
    }

    componentDidMount() {
        const postId = this.props.match.params.postId;
        axios.get('http://45.55.26.18:3310/posts/' + postId )
            .then((res) => {
                this.setState({
                    post: res.data,
                });
            })
            .catch((err) => {
                console.log(err);
            })
    }


    render() {
        const {post} = this.state;
        return (
            <div>
                <div className="mb-3">
                    <Link to="/posts">
                        <Button outline color="secondary">回到文章列表</Button>
                    </Link>
                </div>
                <header className="content__header">
                    <h2 className="content__title">{post.title}</h2>
                </header>
                <div className="content__body">
                    <p className="post-author">
                        <i className="fas fa-user mr-2"></i>
                        {post.author}
                    </p>
                    <p className="post-body">{post.body}</p>
                </div>
            </div>
        )
        
    }
}

export default Post;
